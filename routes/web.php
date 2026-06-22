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
    Route::post('/lapor', [ReportController::class, 'store'])->name('lapor.post');
});

// Rute Admin (Hanya untuk role admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () { 
        return view('admin'); 
    });
});

// Halaman Publik
Route::get('/', function () { return view('home'); });
Route::get('/jelajah', [ReportController::class, 'index'])->name('jelajah');