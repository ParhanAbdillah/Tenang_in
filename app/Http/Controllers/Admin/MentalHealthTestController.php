<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\TestCategory;
use App\Models\TestOption;
use App\Models\TestQuestion;
use App\Models\TestResult;
use id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function storeQuestion(Request $request, $categoryId)
    {
        // 1. Validasi input
        $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:1',
            'options.*.option_text' => 'required|string',
            'options.*.points' => 'required|integer',
        ]);

        try {
            // Menggunakan Database Transaction agar jika satu gagal, semua dibatalkan
            DB::beginTransaction();

            // 2. Simpan Pertanyaan Baru ke tabel test_questions
            $question = TestQuestion::create([
                'test_category_id' => $categoryId,
                'question_text' => $request->question_text,
            ]);

            // 3. Simpan Opsi Jawaban ke tabel test_options
            // Sesuai dengan name="options[index][...]" di Blade yang kita buat sebelumnya
            foreach ($request->options as $option) {
                TestOption::create([
                    'test_question_id' => $question->id,
                    'option_text' => $option['option_text'],
                    'points' => $option['points'], // Kolom points sesuai migration Anda
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Pertanyaan dan bobot skor berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showQuestions($id)
    {
        // 1. Cari kategori berdasarkan ID atau return 404 jika tidak ketemu
        $category = TestCategory::with('questions')->findOrFail($id);

        // 2. Ambil semua pertanyaan yang terkait dengan kategori ini
        $questions = TestQuestion::where('test_category_id', $id)->get();

        // 3. Pastikan view path sesuai dengan struktur folder Anda
        return view('admin.mental_health.questions', compact('category', 'questions'));
    }

    public function destroyQuestion($categoryId, $id)
    {
        $question = TestQuestion::findOrFail($id);
        $question->delete(); // Ini otomatis menghapus opsi jika migration menggunakan onDelete('cascade')

        return redirect()->back()->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
