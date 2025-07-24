<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeadMagnetController;
use App\Helpers\Cities;

Route::get('/', function () {
    return view('utama');
})->name('home');

Route::get('/webinar', function () {
    $cities = Cities::getIndonesianCities();
    return view('webinar', compact('cities'));
})->name('webinar');

Route::get('/webinardua', function () {
    $cities = Cities::getIndonesianCities();
    return view('webinardua', compact('cities'));
})->name('webinardua');

Route::get('/pendaftaran-agen', function () {
    return view('agentreg');
})->name('pendaftaran.agen');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Lead Magnet Routes
Route::post('/lead-magnet/register-ebook', [LeadMagnetController::class, 'registerEbook'])->name('lead-magnet.register-ebook');

// Admin Routes dengan middleware
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Travel Partners
    Route::get('/partners', [AdminController::class, 'partners'])->name('partners');
    Route::get('/partners/create', [AdminController::class, 'createPartner'])->name('partners.create');
    Route::post('/partners', [AdminController::class, 'storePartner'])->name('partners.store');
    
    // Travel Packages
    Route::get('/packages', [AdminController::class, 'packages'])->name('packages');
    Route::get('/packages/create', [AdminController::class, 'createPackage'])->name('packages.create');
    Route::post('/packages', [AdminController::class, 'storePackage'])->name('packages.store');
    
    // Lead Magnet Routes
    Route::prefix('lead-magnet')->name('lead-magnet.')->group(function () {
        Route::get('/calagen-ebook', [LeadMagnetController::class, 'showCalagenEbook'])->name('calagen-ebook');
        Route::get('/calagen-webinar', [LeadMagnetController::class, 'showCalagenWebinar'])->name('calagen-webinar');
    });
});

Route::post('/webinar/register', [WebinarController::class, 'register'])->name('webinar.register');
