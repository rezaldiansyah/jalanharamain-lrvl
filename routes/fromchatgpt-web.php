
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('utama');
})->name('home');

Route::get('/pendaftaran-agen', function () {
    return view('agentreg');
})->name('pendaftaran.agen');
