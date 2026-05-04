<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function index()
    {
        // Mengambil riwayat catatan medis milik psikolog yang sedang login
        $riwayat = MedicalRecord::with('pasien')
            ->where('id_psikolog', Auth::user()->psychologist->id)
            ->latest()
            ->get();

        return view('psychologist.medical_records.index', compact('riwayat'));
    }
    public function show($id)
    {
        $record = MedicalRecord::with('pasien')->findOrFail($id);

        // Pastikan psikolog hanya bisa melihat catatannya sendiri
        if ($record->id_psikolog !== Auth::user()->psychologist->id) {
            abort(403);
        }

        return view('psychologist.medical_records.show', compact('record'));
    }
}
