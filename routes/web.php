<?php

use App\Http\Controllers\Admin\MentalHealthTestController;
use App\Http\Controllers\Admin\PsychologistController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\TestPsikologiController;
use App\Http\Controllers\User\ChatController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES ---
// Pastikan tidak ada middleware 'auth' atau 'guest' yang membungkus ini
Route::get('/Test_psikologi', function () {
    return view('landing_page.test_psikologi');
})->name('test_psikologi')->withoutMiddleware(['auth', 'admin']); // Paksa lepas dari middleware admin
Route::get('/', function () {
    return view('landing_page.index');
})->name('home');


Route::get('/about', function () {
    return view('landing_page.about');
})->name('about');



Route::get('/individual', function () {
    return view('landing_page.individual');
})->name('individual');

/// 1. Halaman Daftar Utama (Masonry Grid)
Route::get('/Test_psikologi', [TestPsikologiController::class, 'index'])->name('test_psikologi');

// Halaman Instruksi (Pake URL lama agar tidak bingung)
Route::get('/test-psikologi/{id}', [TestPsikologiController::class, 'detail'])->name('tes.detail');

// 3. Halaman Pengerjaan (Halaman Slider/Progress Bar)
// Halaman Pengerjaan Soal (Ganti URL-nya agar unik dan tidak bentrok)
Route::get('/pengerjaan-tes/{id}', [TestPsikologiController::class, 'kerjakan'])->name('tes.kerjakan');

// Pastikan baris ini ada di web.php Anda
Route::post('/test-psikologi/submit/{id}', [TestPsikologiController::class, 'submit'])->name('user.test.submit');

// Jika ada yang akses submit dengan GET, redirect ke halaman pengerjaan tes
Route::get('/test-psikologi/submit/{id}', function($id) {
    return redirect()->route('tes.kerjakan', $id);
});

// Route untuk menampilkan hasil tes
Route::get('/test-psikologi/result/{resultId}', [TestPsikologiController::class, 'result'])->name('user.test.result');

// Halaman Detail/Instruksi
Route::get('/test-psikologi/{id}', [TestPsikologiController::class, 'detail'])->name('tes.detail');

// Halaman Pengerjaan Soal (Halaman Slider)
Route::get('/kerjakan-tes/{id}', [TestPsikologiController::class, 'kerjakan'])->name('tes.kerjakan');

// --- USER ROUTES (AFTER LOGIN) ---
Route::get('/chat', function () {
    return view('user.chat.index');
})->name('user.chat');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');


Route::prefix('admin')->name('admin.')->group(function () {

    // Halaman Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard.index');

    // Manajemen Psikolog 
    Route::get('/psychologist', [PsychologistController::class, 'index'])->name('psychologist.index');
    Route::post('/psychologist', [PsychologistController::class, 'store'])->name('psychologist.store');
    Route::put('/psychologist/{id}', [PsychologistController::class, 'update'])->name('psychologist.update');
    Route::delete('/psychologist/{id}', [PsychologistController::class, 'destroy'])->name('psychologist.destroy');

    // Data Master Spesialisasi
    Route::resource('specialization', SpecializationController::class);

    // Jadwal Psikolog
    Route::get('schedule/{psychologist_id}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::post('schedule/store', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::delete('schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

    // AI Settings
    Route::get('ai-settings', [SettingController::class, 'aiConfig'])->name('ai.index');
    Route::post('ai-settings', [SettingController::class, 'updateAiConfig'])->name('ai.update');

    // Manajemen Edukasi (Tes Mental Health)
    // Gunakan prefix 'mental-health' agar rapi dan sesuai dengan Blade
    Route::prefix('mental-health')->name('mental-health.')->group(function () {
        Route::get('/', [MentalHealthTestController::class, 'index'])->name('index');
        Route::post('/category', [MentalHealthTestController::class, 'storeCategory'])->name('category.store');
        
        // Kelola Pertanyaan (Gunakan prefix 'questions' agar URL konsisten)
        Route::prefix('questions')->name('questions.')->group(function () {
            Route::get('/{id}', [MentalHealthTestController::class, 'showQuestions'])->name('index'); // URL: /admin/mental-health/questions/1
            Route::post('/{id}', [MentalHealthTestController::class, 'storeQuestion'])->name('store'); // URL: /admin/mental-health/questions/1
            Route::delete('/{category}/{id}', [MentalHealthTestController::class, 'destroyQuestion'])->name('destroy');
        });
    });
});


// --- ROUTE YANG BUTUH LOGIN (Harus di dalam middleware auth) ---
Route::middleware(['auth'])->group(function () {

    // Pastikan URL ini sinkron dengan yang ada di atribut action form blade Anda
    Route::post('/mental-health-test/submit', [MentalHealthTestController::class, 'storeUserResponse'])->name('mental-health.submit');

    // Halaman untuk melihat hasil (GET)
    Route::get('/mental-health-test/result/{id}', [MentalHealthTestController::class, 'showResult'])->name('user.mental-health.result');
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

// Auth bawaan Laravel (Biarkan saja, tidak usah dipakai dulu)
require __DIR__ . '/auth.php';
