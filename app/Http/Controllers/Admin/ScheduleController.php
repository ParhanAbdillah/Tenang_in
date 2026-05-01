<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Psychologist;
use App\Models\PsychologistSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Menampilkan halaman jadwal spesifik untuk satu psikolog
    public function show($psychologist_id)
    {
        $psychologist = Psychologist::findOrFail($psychologist_id);
        $schedules = PsychologistSchedule::where('psychologist_id', $psychologist_id)
            ->orderBy('day')
            ->get();

        // Pastikan path ini sesuai: resources/views/admin/schedule/index.blade.php
        return view('admin.schedule.index', compact('psychologist', 'schedules'));
    }

    // Menyimpan jadwal baru
    public function store(Request $request)
    {
        // 1. Simpan hasil validasi ke dalam variabel $validated
        $validated = $request->validate([
            'psychologist_id' => 'required|exists:psychologists,id',
            'date' => 'nullable|date',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // 2. Rename 'date' to 'schedule_date' untuk database field
        if (isset($validated['date'])) {
            $validated['schedule_date'] = $validated['date'];
            unset($validated['date']);
        }

        // 3. Logic Profesional: Menghindari jadwal bentrok
        $query = PsychologistSchedule::where('psychologist_id', $request->psychologist_id)
            ->where('day', $request->day)
            ->where('start_time', $request->start_time);

        if ($request->has('date')) {
            $query->where('schedule_date', $request->date);
        }

        if ($query->exists()) {
            return redirect()->back()->with('error', 'Jadwal pada jam tersebut sudah ada!');
        }

        // 4. JANGAN gunakan $request->all() karena mengandung '_token' yang bikin error.
        // Gunakan $validated yang sudah bersih dari token CSRF.
        PsychologistSchedule::create($validated);

        return redirect()->back()->with('success', 'Slot jadwal berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        PsychologistSchedule::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
