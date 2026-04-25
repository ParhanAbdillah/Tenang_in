<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\TestCategory;
use App\Models\TestQuestion;
use App\Models\TestResult;
use id;
use Illuminate\Http\Request;
// use Illuminate\Support\Str;

class MentalHealthTestController extends Controller
{
    public function index()
    {
        // Ambil semua kategori tes beserta jumlah pertanyaannya
        $categories = TestCategory::withCount('questions')->get();
        $specializations = Specialization::all(); // Untuk indikator skor nanti

        return view('admin.mental_health.index', compact('categories', 'specializations'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        TestCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => \Illuminate\Support\Str::slug($request->name),
        ]);

        return redirect()->back()->with('success', 'Kategori Tes berhasil ditambahkan!');
    }

    public function showQuestions($id)
    {
        // Ini akan memunculkan 404 jika ID tidak ada di database
        $category = TestCategory::findOrFail($id);

        // Pastikan orderBy menggunakan kolom 'order' yang baru Anda tambahkan
        $questions = TestQuestion::where('test_category_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.mental_health.questions', compact('category', 'questions'));
    }

    // UNTUK USER: Menampilkan soal supaya bisa dipilih-pilih
    public function showTest($id)
    {
        // Kita tambahkan .options agar pilihan jawabannya ikut terbawa
        $category = TestCategory::with('questions.options')->findOrFail($id);

        // Sesuaikan dengan letak file blade user Anda
        return view('user.mental_health.run_test', compact('category'));
    }

    public function storeQuestion(Request $request, $categoryId)
    {
        $request->validate([
            'question_text' => 'required|string',
        ]);

        TestQuestion::create([
            'test_category_id' => $categoryId,
            'question_text' => $request->question_text,
            'order' => TestQuestion::where('test_category_id', $categoryId)->count() + 1
        ]);

        return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    // Tambahkan method untuk menyimpan jawaban user dan menghitung skor
    public function storeUserResponse(Request $request)
    {
        // 1. Hitung total skor dari semua radio button yang dipilih user
        $totalScore = array_sum($request->options);

        // 2. Tentukan Diagnosa berdasarkan skor (0-21)
        if ($totalScore <= 4) $diagnosis = "Minimal Anxiety";
        elseif ($totalScore <= 9) $diagnosis = "Mild Anxiety";
        elseif ($totalScore <= 14) $diagnosis = "Moderate Anxiety";
        else $diagnosis = "Severe Anxiety";

        // Simpan hasil ke variabel agar kita bisa ambil ID-nya
        $testResult = TestResult::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(), //
            'test_category_id' => $request->category_id,
            'total_score' => $totalScore,
            'diagnosis' => $diagnosis,
            'suggestion' => "Saran otomatis berdasarkan hasil diagnosa..."
        ]);
        return redirect()->route('user.mental-health.result', ['id' => $testResult->id])
                 ->with('success', 'Tes berhasil disimpan!');
    }

    public function startTest($id)
    {
        // Mengambil kategori tes beserta pertanyaan-pertanyaannya
        $category = TestCategory::with('questions.options')->findOrFail($id);

        return view('user.mental_health.run_test', compact('category'));
    }

    public function showResult($id)
{
    // Cari hasil tes berdasarkan ID hasil (Primary Key tabel test_results)
    $result = TestResult::with('category')->findOrFail($id);

    // Pastikan file ini ada di resources/views/user/mental_health/result.blade.php
    return view('user.mental_health.result', compact('result'));
}
}
