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

// Halaman Login (Baru)
Route::get('/login', function () {
    return view('login');
});