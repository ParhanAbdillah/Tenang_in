<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\PsychologistSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $psychologistId = Auth::user()->psychologist->id;

        // Sesuaikan dengan nama kolom: schedule_date, start_time, end_time
        $schedules = PsychologistSchedule::where('psychologist_id', $psychologistId)
            ->where('schedule_date', '>=', now()->toDateString())
            ->orderBy('schedule_date')
            ->orderBy('start_time')
            ->get();

        return view('psychologist.schedules.index', compact('schedules'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $psychologistId = Auth::user()->psychologist->id;
        
        // Gabungkan tanggal dengan jam agar Carbon bisa mendeteksi perbedaan hari
        $start = \Carbon\Carbon::parse($request->tanggal . ' ' . $request->jam_mulai);
        $end = \Carbon\Carbon::parse($request->tanggal . ' ' . $request->jam_selesai);

        // Jika jam selesai lebih kecil dari jam mulai, asumsikan itu melewati tengah malam (hari berikutnya)
        if ($end <= $start) {
            $end->addDay();
        }

        // Opsional: cegah pembuatan slot yang lebih dari 24 jam (mencegah salah input seperti 14:00 - 10:00 yang jadi 20 jam)
        if ($start->diffInHours($end) > 12) {
            return back()->with('error', 'Rentang waktu maksimal adalah 12 jam. Silakan buat slot terpisah jika lebih.');
        }

        $slotCreated = 0;
        while ($start < $end) {
            $slotEnd = (clone $start)->addMinutes(60); // Sesuai session_interval 60 di gambar
            if ($slotEnd > $end) break;

            PsychologistSchedule::create([
                'psychologist_id' => $psychologistId,
                'schedule_date' => $request->tanggal, // Gunakan schedule_date
                'start_time' => $start->format('H:i:s'), // Gunakan start_time
                'end_time' => $slotEnd->format('H:i:s'), // Gunakan end_time
                'day' => \Carbon\Carbon::parse($request->tanggal)->translatedFormat('l'),
                'session_interval' => 60,
                'is_active' => 1
            ]);

            $start->addMinutes(60);
            $slotCreated++;
        }

        if ($slotCreated == 0) {
            return back()->with('error', 'Durasi tidak cukup untuk membuat slot (minimal 60 menit).');
        }

        return redirect()->back()->with('success', 'Slot waktu berhasil dibuat!');
    }

    public function destroy($id)
    {
        $schedule = PsychologistSchedule::findOrFail($id);
        
        // Pastikan hanya psikolog pemilik jadwal yang bisa menghapus
        if ($schedule->psychologist_id !== Auth::user()->psychologist->id) {
            return back()->with('error', 'Akses ditolak.');
        }

        $schedule->delete();

        return redirect()->back()->with('success', 'Slot waktu berhasil dihapus!');
    }
}
