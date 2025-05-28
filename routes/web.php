<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebinarController;
use App\Helpers\Cities;

Route::get('/', function () {
    $cities = Cities::getIndonesianCities();
    return view('webinardua', compact('cities'));
})->name('home');

Route::get('/webinar', function () {
    $cities = Cities::getIndonesianCities();
    return view('webinar', compact('cities'));
})->name('webinar');

Route::get('/webinardua', function () {
    $cities = Cities::getIndonesianCities();
    return view('webinardua', compact('cities'));
})->name('webinardua');

Route::post('/webinar/register', [WebinarController::class, 'register'])->name('webinar.register');
