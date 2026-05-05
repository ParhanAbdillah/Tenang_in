<?php

use App\Http\Controllers\Admin\ClinicalTypeController;
use App\Http\Controllers\Admin\MentalHealthTestController;
use App\Http\Controllers\Admin\PsychologistController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\WebConfigController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Psychologist\ConsultationController;
use App\Http\Controllers\Psychologist\MedicalRecordController;
use App\Http\Controllers\Public\LandingPageController;
use App\Http\Controllers\Public\TestPsikologiController;
use App\Http\Controllers\User\ChatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing_page.index');
})->name('home');
Route::get('/about', function () {
    return view('landing_page.about');
})->name('about');
Route::get('/individual', [LandingPageController::class, 'individual'])->name('individual');

// Test Psikologi Public
Route::get('/Test_psikologi', [TestPsikologiController::class, 'index'])->name('test_psikologi');
Route::get('/test-psikologi/{id}', [TestPsikologiController::class, 'detail'])->name('tes.detail');
Route::get('/pengerjaan-tes/{id}', [TestPsikologiController::class, 'kerjakan'])->name('tes.kerjakan');
Route::get('/test-psikologi/result/{resultId}', [TestPsikologiController::class, 'result'])->name('user.test.result');
Route::post('/test-psikologi/submit/{id}', [TestPsikologiController::class, 'submit'])->name('user.test.submit');





/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Route logout biasanya diletakkan di luar grup guest
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| 2. DASHBOARD BRIDGE (Mengarahkan User Setelah Login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    // Pastikan user benar-benar login
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    $role = strtolower(trim($user->role));

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard.index');
    } elseif ($role === 'psychologist') {
        return redirect()->route('psychologist.dashboard.index');
    }

    return redirect()->route('user.dashboard.index');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| 3. ADMIN ROUTES (Prefix: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard.index');

    // Manajemen Psikolog 
    Route::resource('psychologist', PsychologistController::class);

    // Data Master
    Route::resource('specialization', SpecializationController::class);
    Route::resource('clinical_type', ClinicalTypeController::class);

    // Jadwal Psikolog
    Route::prefix('schedule')->name('schedule.')->group(function () {
        Route::get('/{psychologist_id}', [ScheduleController::class, 'show'])->name('show');
        Route::post('/store', [ScheduleController::class, 'store'])->name('store');
        Route::delete('/{id}', [ScheduleController::class, 'destroy'])->name('destroy');
    });

    // Konfigurasi Web & AI
    Route::get('/config', [WebConfigController::class, 'index'])->name('web_config.index');
    Route::post('/config/update-landing', [WebConfigController::class, 'update'])->name('web_config.update');
    Route::get('/ai-settings', [SettingController::class, 'aiConfig'])->name('ai.index');
    Route::post('/ai-settings', [SettingController::class, 'updateAiConfig'])->name('ai.update');

    // Manajemen Tes Mental Health
    Route::prefix('mental-health')->name('mental-health.')->group(function () {
        Route::get('/', [MentalHealthTestController::class, 'index'])->name('index');
        Route::post('/store', [MentalHealthTestController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{id}', [MentalHealthTestController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{id}', [MentalHealthTestController::class, 'destroyCategory'])->name('categories.destroy');

        Route::get('/indicators/{category_id}', [MentalHealthTestController::class, 'manageIndicators'])->name('indicators.index');
        Route::get('/questions/{id}', [MentalHealthTestController::class, 'showQuestions'])->name('questions.index');
    });
});

/*
|--------------------------------------------------------------------------
| 4. PSYCHOLOGIST ROUTES (Prefix: psychologist)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'psychologist'])->prefix('psychologist')->name('psychologist.')->group(function () {

    // Dashboard Utama Psikolog
    Route::get('/dashboard', function () {
        return view('psychologist.dashboard.index');
    })->name('dashboard.index');

    // Menu Sesi Konsultasi Saya
    Route::get('/sesi-konsultasi', [ConsultationController::class, 'index'])->name('consultations.index');
    Route::post('/consultations/{id}/konfirmasi', [ConsultationController::class, 'konfirmasi'])->name('consultations.konfirmasi');
    Route::get('/consultations/{id}', [ConsultationController::class, 'show'])->name('consultations.show');
    Route::post('/consultations/{id}/selesai', [ConsultationController::class, 'selesai'])->name('consultations.selesai');

    // Menu Riwayat Catatan Medis
    Route::get('/catatan-medis', [MedicalRecordController::class, 'index'])->name('medical_records.index');
    Route::get('/catatan-medis/{id}', [MedicalRecordController::class, 'show'])->name('medical_records.show');

    // Menu Jadwal Saya
    Route::get('/jadwal-anda', [App\Http\Controllers\Psychologist\ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/jadwal-anda/generate', [App\Http\Controllers\Psychologist\ScheduleController::class, 'generate'])->name('schedules.generate');
    Route::delete('/jadwal-anda/{id}', [App\Http\Controllers\Psychologist\ScheduleController::class, 'destroy'])->name('schedules.destroy');
    // Tambahkan route khusus fitur psikolog di sini nanti (Contoh: Jadwal Saya, Konsultasi Masuk)
});

/*
|--------------------------------------------------------------------------
| 5. USER / PATIENT ROUTES (Butuh Login)
|--------------------------------------------------------------------------
*/
Route::get('/daftar-psikolog', [PsychologistController::class, 'userIndex'])->name('user.psychologist.index');
Route::get('/daftar-psikolog/{id}', [PsychologistController::class, 'userDetail'])->name('user.psychologist.detail');

Route::middleware(['auth'])->group(function () {
    // --- Dashboard & Mood Tracker ---
    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->name('user.dashboard.index');

    // Route::post('/mood-tracker', [App\Http\Controllers\Patient\MoodController::class, 'store'])
    //     ->name('patient.mood.store');
    
    // --- Chat & Test (Route yang sudah kamu punya) ---
    Route::get('/chat', [ChatController::class, 'index'])->name('user.chat');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/mental-health-test/submit', [MentalHealthTestController::class, 'storeUserResponse'])->name('mental-health.submit');

    // --- Booking & Checkout ---
    Route::post('/booking/checkout', [App\Http\Controllers\User\BookingController::class, 'checkout'])->name('booking.checkout');

    // --- User Profile ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 6. AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__ . '/auth.php';
