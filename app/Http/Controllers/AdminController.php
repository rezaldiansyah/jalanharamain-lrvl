<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelPartner;
use App\Models\TravelPackage;
use App\Models\Ebook;
use App\Models\User;
use App\Models\Webinar;
use App\Services\BunnyService;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $partnersCount = TravelPartner::count();
        $packagesCount = TravelPackage::count();
        $activePackages = TravelPackage::where('is_active', true)->count();
        
        return view('admin.dashboard', compact('partnersCount', 'packagesCount', 'activePackages'));
    }

    // Travel Partners
    public function partners()
    {
        $partners = TravelPartner::with('user')->latest()->paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function createPartner()
    {
        return view('admin.partners.create');
    }

    public function storePartner(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'ppiu_number' => 'nullable|string|max:255',
            'pihk_number' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            // User fields
            'user_name' => 'nullable|string|max:255',
            'user_email' => 'nullable|email|max:255|unique:users,email',
            'user_password' => 'nullable|string|min:6',
        ]);

        // Create user if user data provided
        $userId = null;
        if ($request->filled(['user_name', 'user_email', 'user_password'])) {
            $user = User::create([
                'name' => $validated['user_name'],
                'email' => $validated['user_email'],
                'password' => Hash::make($validated['user_password']),
                'role' => 'travel',
            ]);
            $userId = $user->id;
        }

        // Create travel partner
        $partnerData = collect($validated)->except(['user_name', 'user_email', 'user_password'])->toArray();
        $partnerData['user_id'] = $userId;
        
        TravelPartner::create($partnerData);
        
        return redirect()->route('admin.partners')->with('success', 'Travel partner berhasil ditambahkan!');
    }

    public function showPartner(TravelPartner $partner)
    {
        $partner->load('user', 'travelPackages');
        return view('admin.partners.show', compact('partner'));
    }

    public function editPartner(TravelPartner $partner)
    {
        $partner->load('user');
        return view('admin.partners.edit', compact('partner'));
    }

    public function updatePartner(Request $request, TravelPartner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'ppiu_number' => 'nullable|string|max:255',
            'pihk_number' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            // User fields
            'user_name' => 'nullable|string|max:255',
            'user_email' => 'nullable|email|max:255|unique:users,email,' . ($partner->user_id ?? 'NULL'),
            'user_password' => 'nullable|string|min:6',
        ]);

        // Update or create user
        if ($request->filled(['user_name', 'user_email'])) {
            if ($partner->user) {
                // Update existing user
                $userData = [
                    'name' => $validated['user_name'],
                    'email' => $validated['user_email'],
                ];
                if ($request->filled('user_password')) {
                    $userData['password'] = Hash::make($validated['user_password']);
                }
                $partner->user->update($userData);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $validated['user_name'],
                    'email' => $validated['user_email'],
                    'password' => Hash::make($validated['user_password'] ?? 'password123'),
                    'role' => 'travel',
                ]);
                $validated['user_id'] = $user->id;
            }
        }

        // Update travel partner
        $partnerData = collect($validated)->except(['user_name', 'user_email', 'user_password'])->toArray();
        $partner->update($partnerData);
        
        return redirect()->route('admin.partners')->with('success', 'Travel partner berhasil diperbarui!');
    }

    public function destroyPartner(TravelPartner $partner)
    {
        // Delete associated user if exists
        if ($partner->user) {
            $partner->user->delete();
        }
        
        $partner->delete();
        
        return redirect()->route('admin.partners')->with('success', 'Travel partner berhasil dihapus!');
    }

    // Travel Packages
    public function packages()
    {
        $packages = TravelPackage::with('travelPartner')->latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function createPackage()
    {
        $partners = TravelPartner::where('is_active', true)->get();
        return view('admin.packages.create', compact('partners'));
    }

    public function storePackage(Request $request)
    {
        $validated = $request->validate([
            'travel_partner_id' => 'required|exists:travel_partners,id',
            'name' => 'required|string|max:255',
            'category' => 'required|in:umroh,haji_khusus,wisata_halal,lainnya',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0|max:999999999999',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_participants' => 'required|integer|min:1',
            'itinerary' => 'nullable|string',
            'includes' => 'nullable|string',
            'excludes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/packages'), $imageName);
            $validated['image'] = 'images/packages/' . $imageName;
        }
    
        TravelPackage::create($validated);
        
        return redirect()->route('admin.packages')->with('success', 'Paket perjalanan berhasil ditambahkan!');
    }

    public function updatePackage(Request $request, TravelPackage $package)
    {
        $validated = $request->validate([
            'travel_partner_id' => 'required|exists:travel_partners,id',
            'name' => 'required|string|max:255',
            'category' => 'required|in:umroh,haji_khusus,wisata_halal,lainnya',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0|max:999999999999',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_participants' => 'required|integer|min:1',
            'itinerary' => 'nullable|string',
            'includes' => 'nullable|string',
            'excludes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($package->image && file_exists(public_path($package->image))) {
                unlink(public_path($package->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/packages'), $imageName);
            $validated['image'] = 'images/packages/' . $imageName;
        }
    
        $package->update($validated);
        
        return redirect()->route('admin.packages')->with('success', 'Paket perjalanan berhasil diperbarui!');
    }

    public function editPackage(TravelPackage $package)
    {
        $partners = TravelPartner::where('is_active', true)->get();
        return view('admin.packages.edit', compact('package', 'partners'));
    }

    public function destroyPackage(TravelPackage $package)
    {
        // Delete image if exists
        if ($package->image && file_exists(public_path($package->image))) {
            unlink(public_path($package->image));
        }
        
        $package->delete();
        
        return redirect()->route('admin.packages')->with('success', 'Paket perjalanan berhasil dihapus!');
    }

     // E-books Management
    public function ebooks()
    {
        $ebooks = Ebook::latest()->paginate(10);
        return view('admin.ebooks.index', compact('ebooks'));
    }

    public function createEbook()
    {
        return view('admin.ebooks.create');
    }

    public function storeEbook(Request $request, BunnyService $bunnyService)
    {
        // Validasi konfigurasi Bunny.net
        if (!config('services.bunny.storage_zone') || !config('services.bunny.access_key')) {
            return back()->withErrors(['file' => 'Konfigurasi Bunny.net belum lengkap. Silakan hubungi administrator.']);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:gratis,berbayar',
            'price' => 'nullable|numeric|min:0|required_if:category,berbayar',
            'file' => 'required|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        // Upload file ke Bunny.net
        $uploadResult = $bunnyService->uploadFile($request->file('file'));
        
        if (!$uploadResult['success']) {
            \Log::error('Bunny.net upload failed', $uploadResult);
            return back()->withErrors(['file' => 'Upload gagal: ' . $uploadResult['message']]);
        }

        // Simpan data e-book
        Ebook::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'price' => $validated['category'] === 'berbayar' ? $validated['price'] : null,
            'file_name' => $uploadResult['file_name'],
            'file_path' => $uploadResult['file_path'],
            'bunny_url' => $uploadResult['bunny_url'],
            'file_size' => $uploadResult['file_size'],
        ]);

        return redirect()->route('admin.ebooks')->with('success', 'E-book berhasil diupload!');
    }

    public function editEbook(Ebook $ebook)
    {
        return view('admin.ebooks.edit', compact('ebook'));
    }

    public function updateEbook(Request $request, Ebook $ebook)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:gratis,berbayar',
            'price' => 'nullable|numeric|min:0|required_if:category,berbayar',
            'is_active' => 'boolean',
        ]);

        $ebook->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'price' => $validated['category'] === 'berbayar' ? $validated['price'] : null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.ebooks')->with('success', 'E-book berhasil diupdate!');
    }

    public function destroyEbook(Ebook $ebook, BunnyService $bunnyService)
    {
        // Hapus file dari Bunny.net
        $bunnyService->deleteFile($ebook->file_path);
        
        // Hapus record dari database
        $ebook->delete();

        return redirect()->route('admin.ebooks')->with('success', 'E-book berhasil dihapus!');
    }

    public function duplicatePackage(TravelPackage $package)
    {
        // Buat salinan data paket
        $duplicatedData = $package->toArray();
        
        // Hapus ID dan timestamps untuk membuat record baru
        unset($duplicatedData['id'], $duplicatedData['created_at'], $duplicatedData['updated_at']);
        
        // Modifikasi nama untuk menunjukkan ini adalah duplikat
        $duplicatedData['name'] = $duplicatedData['name'] . ' (Copy)';
        
        // Set status menjadi tidak aktif untuk review
        $duplicatedData['is_active'] = false;
        
        // Handle duplikasi gambar jika ada
        if ($package->image && file_exists(public_path($package->image))) {
            $originalImagePath = public_path($package->image);
            $imageInfo = pathinfo($package->image);
            $newImageName = time() . '_copy_' . $imageInfo['basename'];
            $newImagePath = public_path('images/packages/' . $newImageName);
            
            // Copy file gambar
            if (copy($originalImagePath, $newImagePath)) {
                $duplicatedData['image'] = 'images/packages/' . $newImageName;
            } else {
                // Jika gagal copy, hapus referensi gambar
                $duplicatedData['image'] = null;
            }
        }
        
        // Buat paket baru
        $newPackage = TravelPackage::create($duplicatedData);
        
        return redirect()->route('admin.packages.edit', $newPackage)
                        ->with('success', 'Paket berhasil diduplikat! Silakan review dan edit sesuai kebutuhan.');
    }
    
    // Tambah methods:
    public function webinars()
    {
        $webinars = Webinar::withCount('registrations')->latest()->paginate(10);
        return view('admin.webinars.index', compact('webinars'));
    }
    
    public function createWebinar()
    {
        return view('admin.webinars.create');
    }
    
    public function storeWebinar(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'platform' => 'required|string',
            'meeting_link' => 'nullable|url',
            'community_link' => 'nullable|url', // Field baru
            'max_participants' => 'nullable|integer|min:1',
            'template' => 'required|in:webinar,webinardua',
            'is_free' => 'boolean',
            'price' => 'nullable|numeric|min:0',
            'custom_content' => 'nullable|json'
        ]);
        
        // Set is_free berdasarkan harga
        $validated['is_free'] = empty($validated['price']) || $validated['price'] == 0;
        
        $webinar = Webinar::create($validated);
        
        return redirect()->route('admin.webinars.index')
            ->with('success', 'Webinar berhasil dibuat!')
            ->with('webinar_url', $webinar->getPublicUrl());
    }
    
    public function editWebinar(Webinar $webinar)
    {
        return view('admin.webinars.edit', compact('webinar'));
    }
    
    public function updateWebinar(Request $request, Webinar $webinar)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'platform' => 'required|string',
            'meeting_link' => 'nullable|url',
            'community_link' => 'nullable|url', // Field baru
            'max_participants' => 'nullable|integer|min:1',
            'template' => 'required|in:webinar,webinardua',
            'is_free' => 'boolean',
            'price' => 'nullable|numeric|min:0',
            'custom_content' => 'nullable|json'
        ]);
        
        // Set is_free berdasarkan harga
        $validated['is_free'] = empty($validated['price']) || $validated['price'] == 0;
        
        // Set status berdasarkan checkbox
        $validated['status'] = $request->has('is_active') ? 'published' : 'draft';
        
        $webinar->update($validated);
        
        return redirect()->route('admin.webinars.index')
            ->with('success', 'Webinar berhasil diperbarui!');
    }
    
    public function destroyWebinar(Webinar $webinar)
    {
        $webinar->delete();
        
        return redirect()->route('admin.webinars.index')
            ->with('success', 'Webinar berhasil dihapus!');
    }
}