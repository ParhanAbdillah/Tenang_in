<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index(Request $request)
{
    $query = Appointment::with('pasien')
        ->where('id_psikolog', Auth::user()->psychologist->id);

    // Filter berdasarkan status jika ada kiriman dari dropdown
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $daftarKonsultasi = $query->orderBy('tanggal_janji', 'asc')
                              ->orderBy('jam_janji', 'asc')
                              ->get();

    return view('psychologist.consultations.index', compact('daftarKonsultasi'));
}

    public function konfirmasi($id)
    {
        $janji = Appointment::findOrFail($id);

        // Pastikan hanya psikolog yang bersangkutan yang bisa konfirmasi
        if ($janji->id_psikolog !== Auth::user()->psychologist->id) {
            return back()->with('error', 'Akses ditolak.');
        }

        $janji->update(['status' => 'dikonfirmasi']);

        return back()->with('success', 'Janji temu berhasil dikonfirmasi!');
    }

    public function show($id)
    {
        $janji = Appointment::with('pasien')->findOrFail($id);

        // Keamanan: Pastikan hanya psikolog pemilik janji yang bisa membuka
        if ($janji->id_psikolog !== Auth::user()->psychologist->id) {
            abort(403, 'Akses tidak sah.');
        }

        return view('psychologist.consultations.show', compact('janji'));
    }

    public function selesai(Request $request, $id)
    {
        $request->validate([
            'catatan_konsultasi' => 'required|min:10',
        ]);

        $janji = Appointment::findOrFail($id);

        // 1. Simpan ke tabel catatan_medis
        MedicalRecord::create([
            'id_janji' => $janji->id,
            'id_pasien' => $janji->id_pasien,
            'id_psikolog' => $janji->id_psikolog,
            'catatan_konsultasi' => $request->catatan_konsultasi,
        ]);

        // 2. Update status janji temu menjadi selesai
        $janji->update(['status' => 'selesai']);

        return redirect()->route('psychologist.consultations.index')
            ->with('success', 'Sesi konsultasi telah diselesaikan dan catatan disimpan.');
    }
}
