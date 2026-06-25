<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// --- HALAMAN PUBLIK ---
Route::get('/', function () {
    return view('home');
});

Route::get('/jelajah', [ReportController::class, 'index'])->name('jelajah');

// --- AUTENTIKASI ---
Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- HALAMAN WAJIB LOGIN ---
Route::middleware('auth')->group(function () {
    
    // Fitur Lapor
    Route::get('/lapor', function () {
        return view('lapor');
    });
    
    // PERBAIKAN: Mengubah nama rute menjadi 'lapor.post' agar cocok dengan file blade
    Route::post('/lapor', [ReportController::class, 'store'])->name('lapor.post');
    
    // Rute Profil Pintar (Berubah sesuai Role)
    Route::get('/profil', function () {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            // Jika yang klik profil adalah Admin, muat data dasbor
            $reports = Report::with('user')->orderBy('created_at', 'desc')->get();
            $users = User::withCount('reports')->get();
            $totalUsers = $users->count();
            
            return view('admin', compact('reports', 'users', 'totalUsers'));
        } else {
            // Jika yang klik profil adalah Warga biasa
            return view('profil');
        }
    })->name('profil');

    // Aksi Khusus Admin (Verifikasi Status Laporan)
    Route::middleware('admin')->group(function () {
        Route::post('/admin/report/{id}/approve', [ReportController::class, 'approve'])->name('admin.report.approve');
        Route::post('/admin/report/{id}/reject', [ReportController::class, 'reject'])->name('admin.report.reject');
    });
    
});