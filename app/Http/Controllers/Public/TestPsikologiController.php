<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TestCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestPsikologiController extends Controller
{
    // Menampilkan halaman utama Tes Psikologi (Daftar Card)
    public function index()
    {
        // Mengambil kategori tes beserta jumlah soalnya sekaligus
        $daftar_tes = TestCategory::withCount('questions')->get();

        return view('landing_page.test_psikologi', compact('daftar_tes'));
    }

    public function detail($id)
    {
        $tes = TestCategory::findOrFail($id);
        return view('landing_page.detail_tes', compact('tes'));
    }

    public function show($id)
    {
        // Mengambil tes beserta daftar soalnya
        $tes = TestCategory::with('questions')->findOrFail($id);
        return view('landing_page.kerjakan_tes', compact('tes'));
    }

    // Menampilkan halaman pengerjaan soal (Halaman Slider/Progress Bar)
    public function kerjakan($id)
    {
        // 1. Ambil kategori beserta soal & pilihan (pake relasi 'questions')
        $kategori = TestCategory::with(['questions.testOptions'])->findOrFail($id);

        // 2. Hapus duplikat opsi bila ada karena seeder atau data ganda
        $kategori->questions->each(function ($question) {
            $question->setRelation('testOptions', $question->testOptions->unique('option_text')->values());
        });

        // 3. Simpan soal ke variabel $soals
        $soals = $kategori->questions;

        // 4. Kirim ke view (Pastikan namanya 'soals' sesuai variabel di Blade)
        return view('landing_page.kerjakan_tes', compact('kategori', 'soals'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate(['jawaban' => 'required|array']);

        $totalSkor = 0;
        foreach ($request->jawaban as $soalId => $optionId) {
            $option = \App\Models\TestOption::find($optionId);
            if ($option) {
                $totalSkor += $option->points; // Mengambil bobot skor
            }
        }

        // Ambil indikator dari database berdasarkan skor
        $indikator = \App\Models\TestScoreIndicator::where('test_category_id', $id)
            ->where('min_score', '<=', $totalSkor)
            ->where('max_score', '>=', $totalSkor)
            ->first();

        // Simpan hasil tes
        $result = \App\Models\TestResult::create([
            'user_id' => Auth::id(),
            'test_category_id' => $id,
            'total_score' => $totalSkor,
            'diagnosis' => $indikator->status ?? 'Tidak Teridentifikasi',
            'suggestion' => $indikator->recommendation ?? 'Segera konsultasikan dengan tenaga profesional.',
            'color_result' => $indikator->color ?? '#0A4D68' // Warna otomatis dari database!
        ]);

        return redirect()->route('user.test.result', $result->id);
    }


    public function result($resultId)
    {
        // Eager loading relasi category dan user
        $result = \App\Models\TestResult::with('category')->findOrFail($resultId);

        $totalSkor = $result->total_score;
        $kategori = $result->category;

        // Ambil indikator lengkap dengan relasi spesialisasi agar nama spesialis muncul
        $indikator = \App\Models\TestScoreIndicator::with('specialization')
            ->where('test_category_id', $kategori->id)
            ->where('min_score', '<=', $totalSkor)
            ->where('max_score', '>=', $totalSkor)
            ->first();

        // Tentukan warna: Ambil dari hasil yang disimpan atau dari indikator saat ini
        $warna = $result->color_result ?? ($indikator->color ?? '#0A4D68');

        return view('landing_page.hasil_tes', compact(
            'totalSkor',
            'kategori',
            'indikator',
            'result',
            'warna'
        ));
    }
}
