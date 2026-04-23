<?php

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
});

// Auth bawaan Laravel (Biarkan saja, tidak usah dipakai dulu)
require __DIR__ . '/auth.php';
