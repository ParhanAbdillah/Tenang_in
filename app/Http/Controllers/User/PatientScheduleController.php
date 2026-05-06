<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientScheduleController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('psikolog')
            ->where('id_pasien', Auth::id())
            ->orderBy('tanggal_janji', 'desc')
            ->orderBy('jam_janji', 'desc')
            ->get();

        return view('patient.schedule.index', compact('appointments'));
    }

    public function showRoom($id)
    {
        $janji = Appointment::with('psikolog')->findOrFail($id);

        // Keamanan: Pastikan hanya pasien pemilik janji yang bisa membuka
        if ($janji->id_pasien !== Auth::id()) {
            abort(403, 'Akses tidak sah.');
        }

        // Pastikan status jadwal memungkinkan untuk dibuka
        if (!in_array($janji->status, ['dijadwalkan', 'dikonfirmasi'])) {
            return back()->with('error', 'Sesi ini belum siap atau sudah selesai.');
        }

        return view('patient.schedule.room', compact('janji'));
    }
}
