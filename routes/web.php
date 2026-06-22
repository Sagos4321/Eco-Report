<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

// --- SOLUSI 404: Tangkap redirect bawaan Laravel ---
Route::redirect('/home', '/');
// ---------------------------------------------------

// Rute untuk Tamu (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Rute untuk User yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [AuthController::class, 'profile'])->name('profil');
    Route::get('/lapor', [ReportController::class, 'create'])->name('lapor');
    Route::post('/lapor', [ReportController::class, 'store'])->name('lapor.post');Route::post('/report/{id}/comment', [ReportController::class, 'addComment'])->name('report.comment');
    Route::post('/report/{id}/like', [ReportController::class, 'toggleLike'])->name('report.like');
});

// Rute Admin (Hanya untuk role admin)
Route::middleware(['auth', 'admin'])->group(function () {
    // Menampilkan halaman admin dengan data laporan
    Route::get('/admin', function () { 
        $reports = \App\Models\Report::with('user')->orderBy('created_at', 'desc')->get();
        $totalUsers = \App\Models\User::count();
        $users = \App\Models\User::withCount('reports')->orderBy('reports_count', 'desc')->get();
        return view('admin', compact('reports', 'totalUsers', 'users')); 
    })->name('admin.dashboard');

    // Aksi Setujui dan Tolak
    Route::post('/admin/report/{id}/approve', [ReportController::class, 'approve'])->name('admin.report.approve');
    Route::post('/admin/report/{id}/reject', [ReportController::class, 'reject'])->name('admin.report.reject');
});

// Halaman Publik
Route::get('/', function () { return view('home'); });
Route::get('/jelajah', [ReportController::class, 'index'])->name('jelajah');