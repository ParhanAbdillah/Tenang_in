<?php

use App\Http\Controllers\Admin\PsychologistController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\ProfileController;
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


Route::prefix('admin')->name('admin.')->group(function () {
    
    // Halaman Dashboard
   // Ganti bagian dashboard di web.php menjadi ini:
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
    

    // Pengaturan AI
    Route::get('/ai-settings', [SettingController::class, 'aiConfig'])->name('ai');
    Route::post('/ai-settings', [SettingController::class, 'updateAiConfig'])->name('ai.update');
});

// Auth bawaan Laravel (Biarkan saja, tidak usah dipakai dulu)
require __DIR__ . '/auth.php';