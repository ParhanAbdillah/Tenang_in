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
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Siapkan data dasar
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => \Illuminate\Support\Str::slug($request->name),
        ];

        // 3. LOGIKA KRUSIAL: Simpan file dan masukkan path-nya ke array $data
        if ($request->hasFile('image')) {
            // Ini akan menyimpan file ke folder storage/app/public/categories
            $path = $request->file('image')->store('categories', 'public');

            // Baris ini yang membuat data di database TIDAK NULL
            $data['image'] = $path;
        }

        // 4. Simpan ke database dengan membawa array $data yang sudah berisi 'image'
        \App\Models\TestCategory::create($data);

        return redirect()->back()->with('success', 'Kategori Tes berhasil ditambahkan!');
    }


    public function updateCategory(Request $request, $id)
    {
        $category = TestCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => \Illuminate\Support\Str::slug($request->name),
        ];

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
                unlink(storage_path('app/public/' . $category->image));
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroyCategory($id)
    {
        $category = TestCategory::findOrFail($id);

        // Hapus foto dari storage
        if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
            unlink(storage_path('app/public/' . $category->image));
        }

        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
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
    // menghapus pertanyaan tes
    public function destroyQuestion($categoryId, $id)
    {
        $question = TestQuestion::findOrFail($id);
        $question->delete(); // Ini otomatis menghapus opsi jika migration menggunakan onDelete('cascade')

        return redirect()->back()->with('success', 'Pertanyaan berhasil dihapus.');
    }
    //menghapus kategori tes

    // Kelola Indikator Skor

    public function manageIndicators($category_id)
    {
        $category = \App\Models\TestCategory::findOrFail($category_id);
        $indicators = \App\Models\TestScoreIndicator::where('test_category_id', $category_id)
            ->with('specialization')
            ->orderBy('min_score', 'asc')
            ->get();

        $specializations = \App\Models\Specialization::all();

        return view('admin.mental_health.indicators', compact('category', 'indicators', 'specializations'));
    }

    public function storeIndicator(Request $request, $category_id)
    {
        $request->validate([
            'min_score' => 'required|integer',
            'max_score' => 'required|integer',
            'status' => 'required|string',
            'color' => 'required|string',
            'recommended_specialization_id' => 'nullable|exists:specializations,id'
        ]);

        \App\Models\TestScoreIndicator::create([
            'test_category_id' => $category_id,
            'min_score' => $request->min_score,
            'max_score' => $request->max_score,
            'status' => $request->status,
            'color' => $request->color,
            'description' => $request->description,
            'recommendation' => $request->recommendation,
            'recommended_specialization_id' => $request->recommended_specialization_id,
        ]);

        return redirect()->back()->with('success', 'Indikator skor berhasil ditambahkan!');
    }

    public function destroyIndicator($id)
    {
        \App\Models\TestScoreIndicator::destroy($id);
        return redirect()->back()->with('success', 'Indikator berhasil dihapus!');
    }
}
