<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

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
    Route::post('/lapor', [ReportController::class, 'store'])->name('lapor.post');
    
    // Rute Profil Pintar
    Route::get('/profil', function () {
    $user = Auth::user();
    
    if ($user->role === 'admin') {
        $reports = Report::with('user')->orderBy('created_at', 'desc')->get();
        $users = User::withCount('reports')->get();
        $totalUsers = $users->count();
        
        // --- FITUR BARU: Menghitung laporan anonim ---
        $anonymousCount = Report::whereNull('user_id')->count();
        
        return view('admin', compact('reports', 'users', 'totalUsers', 'anonymousCount'));
    } else {
        $myReports = Report::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('profil', compact('myReports'));
    }
})->name('profil');

    // FITUR BARU: Rute Hapus Laporan
    Route::delete('/report/{id}', [ReportController::class, 'destroy'])->name('report.destroy');

    // Fitur Komentar & Like
    Route::post('/report/{id}/comment', [ReportController::class, 'addComment'])->name('report.comment');
    Route::post('/report/{id}/like', [ReportController::class, 'toggleLike'])->name('report.like');

    // Aksi Khusus Admin
    Route::middleware('admin')->group(function () {
        Route::post('/admin/report/{id}/approve', [ReportController::class, 'approve'])->name('admin.report.approve');
        Route::post('/admin/report/{id}/reject', [ReportController::class, 'reject'])->name('admin.report.reject');
    });
    
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil/update', [ProfileController::class, 'update'])->name('profile.update');
});