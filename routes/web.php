<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jelajah', function () {
    return view('jelajah');
});

Route::get('/lapor', function () {
    return view('lapor');
});

Route::get('/login', function () {
    return view('login');
});

// Halaman Dasbor Admin
Route::get('/admin', function () {
    return view('admin');
});

// Halaman Profil Pengguna
Route::get('/profil', function () {
    return view('profil');
});