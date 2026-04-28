<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\PrintController;
use App\Http\Controllers\Student\RegistrationController as StudentRegistration;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Breeze auth routes
require __DIR__ . '/auth.php';

// Redirect setelah login berdasarkan role
Route::middleware('auth')->get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('student.dashboard');
})->name('dashboard');

// Profile routes (Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Siswa
    Route::get('/students/export', [AdminStudentController::class, 'export'])->name('students.export');
    Route::resource('students', AdminStudentController::class)->only(['index', 'show', 'destroy']);

    // Jurusan
    Route::resource('majors', MajorController::class)->except(['show']);

    // Pendaftaran
    Route::patch('/registrations/{registration}/verify', [AdminRegistrationController::class, 'verify'])->name('registrations.verify');
    Route::resource('registrations', AdminRegistrationController::class)->only(['index', 'show']);

    // Pengumuman
    Route::resource('announcements', AnnouncementController::class)->except(['show']);

    // Jadwal
    Route::resource('schedules', ScheduleController::class)->except(['show']);
});

// Student routes
Route::middleware(['auth', 'student'])->prefix('siswa')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');

    // Multi-step registration
    Route::get('/daftar/step-1', [StudentRegistration::class, 'step1'])->name('registration.step1');
    Route::post('/daftar/step-1', [StudentRegistration::class, 'storeStep1'])->name('registration.step1.store');

    Route::get('/daftar/step-2', [StudentRegistration::class, 'step2'])->name('registration.step2');
    Route::post('/daftar/step-2', [StudentRegistration::class, 'storeStep2'])->name('registration.step2.store');

    Route::get('/daftar/step-3', [StudentRegistration::class, 'step3'])->name('registration.step3');
    Route::post('/daftar/upload-dokumen', [StudentRegistration::class, 'uploadDocument'])->name('registration.upload');

    Route::get('/daftar/selesai', [StudentRegistration::class, 'complete'])->name('registration.complete');

    // Detail & edit pendaftaran
    Route::get('/pendaftaran/detail', [StudentRegistration::class, 'show'])->name('registration.show');
    Route::put('/pendaftaran/update-jurusan', [StudentRegistration::class, 'updateMajor'])->name('registration.update.major');

    // Cetak bukti PDF
    Route::get('/cetak-bukti', [PrintController::class, 'buktiPendaftaran'])->name('print.bukti');
});
