<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeadMagnetController;
use App\Http\Controllers\AgenController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\HomeController; // Tambahkan ini
use App\Helpers\Cities;

// Update route home
Route::get('/', [HomeController::class, 'index'])->name('home');

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

// Agen Routes - untuk calon-agen dan agen
Route::prefix('agen')->name('agen.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AgenController::class, 'dashboard'])->name('dashboard');
    Route::get('/ebook-gratis', [AgenController::class, 'ebookGratis'])->name('ebook-gratis');
    Route::get('/ebook/{ebook}', [AgenController::class, 'viewEbook'])->name('ebook.view');
    // PDF Proxy Route - hapus middleware auth yang duplikat
    Route::get('/ebook-proxy/{ebook}', [AgenController::class, 'ebookProxy'])->name('ebook.proxy');
});

// Admin Routes dengan middleware
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Travel Partners - Manual Routes (mengganti resource route)
    Route::get('/partners', [AdminController::class, 'partners'])->name('partners');
    Route::get('/partners/create', [AdminController::class, 'createPartner'])->name('partners.create');
    Route::post('/partners', [AdminController::class, 'storePartner'])->name('partners.store');
    Route::get('/partners/{partner}', [AdminController::class, 'showPartner'])->name('partners.show');
    Route::get('/partners/{partner}/edit', [AdminController::class, 'editPartner'])->name('partners.edit');
    Route::put('/partners/{partner}', [AdminController::class, 'updatePartner'])->name('partners.update');
    Route::delete('/partners/{partner}', [AdminController::class, 'destroyPartner'])->name('partners.destroy');
    
    // Travel Packages
    Route::get('/packages', [AdminController::class, 'packages'])->name('packages');
    Route::get('/packages/create', [AdminController::class, 'createPackage'])->name('packages.create');
    Route::post('/packages', [AdminController::class, 'storePackage'])->name('packages.store');
    Route::get('/packages/{package}/edit', [AdminController::class, 'editPackage'])->name('packages.edit');
    Route::put('/packages/{package}', [AdminController::class, 'updatePackage'])->name('packages.update');
    Route::post('/packages/{package}/duplicate', [AdminController::class, 'duplicatePackage'])->name('packages.duplicate');
    Route::delete('/packages/{package}', [AdminController::class, 'destroyPackage'])->name('packages.destroy');
    
    // Lead Magnet Routes
    Route::prefix('lead-magnet')->name('lead-magnet.')->group(function () {
        Route::get('/calagen-ebook', [LeadMagnetController::class, 'showCalagenEbook'])->name('calagen-ebook');
        Route::get('/calagen-webinar', [LeadMagnetController::class, 'showCalagenWebinar'])->name('calagen-webinar');
    });

    // E-book management
    Route::get('/ebooks', [AdminController::class, 'ebooks'])->name('ebooks');
    Route::get('/ebooks/create', [AdminController::class, 'createEbook'])->name('ebooks.create');
    Route::post('/ebooks', [AdminController::class, 'storeEbook'])->name('ebooks.store');
    Route::get('/ebooks/{ebook}/edit', [AdminController::class, 'editEbook'])->name('ebooks.edit');
    Route::put('/ebooks/{ebook}', [AdminController::class, 'updateEbook'])->name('ebooks.update');
    Route::delete('/ebooks/{ebook}', [AdminController::class, 'destroyEbook'])->name('ebooks.destroy');

    // Tambah di dalam admin group:
    // Webinar management - ubah dari route yang ada
    Route::get('/webinars', [AdminController::class, 'webinars'])->name('webinars.index');
    Route::get('/webinars/create', [AdminController::class, 'createWebinar'])->name('webinars.create');
    Route::post('/webinars', [AdminController::class, 'storeWebinar'])->name('webinars.store');
    Route::get('/webinars/{webinar}/edit', [AdminController::class, 'editWebinar'])->name('webinars.edit');
    Route::put('/webinars/{webinar}', [AdminController::class, 'updateWebinar'])->name('webinars.update');
    Route::delete('/webinars/{webinar}', [AdminController::class, 'destroyWebinar'])->name('webinars.destroy');
});

// Public webinar routes
Route::get('/webinars', [WebinarController::class, 'index'])->name('webinars.index');
Route::post('/webinar/register', [WebinarController::class, 'register'])->name('webinar.register');

// Travel Routes - untuk travel partner
Route::prefix('travel')->name('travel.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TravelController::class, 'dashboard'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [TravelController::class, 'profile'])->name('profile');
    Route::get('/profile/create', [TravelController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [TravelController::class, 'storeProfile'])->name('profile.store');
    Route::get('/profile/edit', [TravelController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [TravelController::class, 'updateProfile'])->name('profile.update');
    
    // Package Management
    Route::get('/packages', [TravelController::class, 'packages'])->name('packages');
    Route::get('/packages/create', [TravelController::class, 'createPackage'])->name('packages.create');
    Route::post('/packages', [TravelController::class, 'storePackage'])->name('packages.store');
    Route::get('/packages/{package}/edit', [TravelController::class, 'editPackage'])->name('packages.edit');
    Route::put('/packages/{package}', [TravelController::class, 'updatePackage'])->name('packages.update');
    Route::delete('/packages/{package}', [TravelController::class, 'destroyPackage'])->name('packages.destroy');
});

// Test Bunny.net connection (hanya untuk development)
Route::get('/test-bunny', function() {
    if (!config('app.debug')) {
        abort(404);
    }
    
    $bunnyService = new \App\Services\BunnyService();
    $result = $bunnyService->testConnection();
    
    return response()->json([
        'config' => [
            'storage_zone' => config('services.bunny.storage_zone'),
            'pull_zone' => config('services.bunny.pull_zone'),
            'region' => config('services.bunny.region'),
            'access_key_exists' => !empty(config('services.bunny.access_key'))
        ],
        'connection_test' => $result
    ]);
});

// Debug route untuk Bunny.net (tambahkan di akhir file)
Route::get('/debug-bunny', function() {
    return response()->json([
        'app_debug' => config('app.debug'),
        'bunny_config' => [
            'storage_zone' => config('services.bunny.storage_zone'),
            'pull_zone' => config('services.bunny.pull_zone'),
            'region' => config('services.bunny.region'),
            'access_key_exists' => !empty(config('services.bunny.access_key'))
        ],
        'env_check' => [
            'BUNNY_STORAGE_ZONE' => env('BUNNY_STORAGE_ZONE'),
            'BUNNY_PULL_ZONE' => env('BUNNY_PULL_ZONE'),
            'BUNNY_REGION' => env('BUNNY_REGION'),
            'BUNNY_ACCESS_KEY_EXISTS' => !empty(env('BUNNY_ACCESS_KEY'))
        ]
    ]);
});

// Debug route untuk melihat URL e-book
Route::get('/debug-ebook/{ebook}', function($id) {
    if (!config('app.debug')) {
        abort(404);
    }
    
    $ebook = \App\Models\Ebook::findOrFail($id);
    
    return response()->json([
        'ebook_id' => $ebook->id,
        'title' => $ebook->title,
        'bunny_url' => $ebook->bunny_url,
        'file_path' => $ebook->file_path,
        'url_length' => strlen($ebook->bunny_url),
        'url_analysis' => [
            'has_extra_chars' => preg_match('/\.pdf\d+$/', $ebook->bunny_url),
            'ends_with_pdf' => str_ends_with($ebook->bunny_url, '.pdf'),
            'url_parts' => parse_url($ebook->bunny_url)
        ]
    ]);
});

Route::get('/test-bunny-manual', [App\Http\Controllers\TestController::class, 'testBunny']);

// Fix corrupted Bunny URLs (hanya untuk development)
Route::get('/fix-bunny-urls', function() {
    if (!config('app.debug')) {
        abort(404);
    }
    
    $bunnyService = new \App\Services\BunnyService();
    $ebooks = \App\Models\Ebook::all();
    $fixed = [];
    
    foreach ($ebooks as $ebook) {
        if (str_contains($ebook->bunny_url, '`') || str_contains($ebook->bunny_url, 'https://https://')) {
            $originalUrl = $ebook->bunny_url;
            $fixedUrl = $bunnyService->fixCorruptedUrl($originalUrl);
            
            if ($fixedUrl) {
                $ebook->update(['bunny_url' => $fixedUrl]);
                $fixed[] = [
                    'id' => $ebook->id,
                    'title' => $ebook->title,
                    'original_url' => $originalUrl,
                    'fixed_url' => $fixedUrl
                ];
            }
        }
    }
    
    return response()->json([
        'message' => 'URLs fixed',
        'fixed_count' => count($fixed),
        'fixed_urls' => $fixed
    ]);
});

// Hapus rute yang ada dan ganti dengan ini:
// Route dinamis untuk webinar (letakkan di akhir file sebelum catch-all routes)
Route::get('webinar/{type}/{date}', [WebinarController::class, 'showBySlug'])
    ->where('type', 'free|paid')
    ->where('date', '[0-9]{8}')
    ->name('webinar.show');

// Atau route yang lebih fleksibel:
// Hapus baris ini:
// Route::get('{slug}', [WebinarController::class, 'showBySlug'])
//     ->where('slug', 'webinar/.*')
//     ->name('webinar.dynamic');
