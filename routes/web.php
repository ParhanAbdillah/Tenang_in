<?php

use App\Http\Controllers\Admin\MentalHealthTestController;
use App\Http\Controllers\Admin\PsychologistController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ChatController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES (LANDING PAGE) ---
Route::get('/', function () {
    return view('landing_page.index');
})->name('home');

Route::get('/about', function () {
    return view('landing_page.about');
})->name('about');

Route::get('/individual', function () {
    return view('landing_page.individual');
})->name('individual');

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

    // Rute untuk membuka halaman (Ini yang menyebabkan 404 jika tidak ada)
    Route::get('ai-settings', [SettingController::class, 'aiConfig'])->name('ai.index');
    Route::redirect('ai-seeting', 'ai-settings', 301);

    // Rute untuk memproses simpan data
    Route::post('ai-settings', [SettingController::class, 'updateAiConfig'])->name('ai.update');

    // Manajemen Edukasi (Tes Mental Health)
    Route::get('/mental-health-test', [MentalHealthTestController::class, 'index'])->name('mental-health.index');
    Route::post('/mental-health-test/category', [MentalHealthTestController::class, 'storeCategory'])->name('mental-health.category.store');

    // Kelola Pertanyaan
    Route::get('/mental-health-test/{id}/questions', [MentalHealthTestController::class, 'showQuestions'])->name('mental-health.questions');
    Route::post('/mental-health-test/{id}/questions', [MentalHealthTestController::class, 'storeQuestion'])->name('mental-health.questions.store');
});

// --- ROUTE UNTUK USER (Bisa diakses siapa saja/Guest) ---
Route::get('/mental-health-test/{id}', [MentalHealthTestController::class, 'showTest'])->name('user.test.show');

// --- ROUTE YANG BUTUH LOGIN (Harus di dalam middleware auth) ---
Route::middleware(['auth'])->group(function () {
    
    // Route UNTUK PROSES SIMPAN (POST)
    // Pastikan URL ini sinkron dengan yang ada di atribut action form blade Anda
    Route::post('/mental-health-test/submit', [MentalHealthTestController::class, 'storeUserResponse'])->name('mental-health.submit');

    // Halaman untuk melihat hasil (GET)
    Route::get('/mental-health-test/result/{id}', [MentalHealthTestController::class, 'showResult'])->name('user.mental-health.result');
    
});

// Auth bawaan Laravel (Biarkan saja, tidak usah dipakai dulu)
require __DIR__ . '/auth.php';
