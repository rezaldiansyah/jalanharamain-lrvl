<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelPartner;
use App\Models\TravelPackage;
use Illuminate\Support\Facades\Auth;

class TravelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isTravel()) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if (!$travelPartner) {
            return redirect()->route('travel.profile.create')
                ->with('warning', 'Silakan lengkapi profil travel partner Anda terlebih dahulu.');
        }

        $totalPackages = $travelPartner->travelPackages()->count();
        $activePackages = $travelPartner->travelPackages()->where('is_active', true)->count();
        $recentPackages = $travelPartner->travelPackages()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('travel.dashboard', compact(
            'travelPartner', 
            'totalPackages', 
            'activePackages', 
            'recentPackages'
        ));
    }

    public function packages()
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if (!$travelPartner) {
            return redirect()->route('travel.profile.create')
                ->with('warning', 'Silakan lengkapi profil travel partner Anda terlebih dahulu.');
        }

        $packages = $travelPartner->travelPackages()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('travel.packages.index', compact('packages', 'travelPartner'));
    }

    public function createPackage()
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if (!$travelPartner) {
            return redirect()->route('travel.profile.create')
                ->with('warning', 'Silakan lengkapi profil travel partner Anda terlebih dahulu.');
        }

        return view('travel.packages.create', compact('travelPartner'));
    }

    public function storePackage(Request $request)
    {
        $validated = $request->validate([
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
            'agent_fee' => 'nullable|numeric|min:0',
            'agent_fee_type' => 'required_with:agent_fee|in:fixed,percentage',
        ]);
    
        // Set travel partner ID dari user yang login
        $validated['travel_partner_id'] = auth()->user()->travelPartner->id;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/packages'), $imageName);
            $validated['image'] = 'images/packages/' . $imageName;
        }
    
        TravelPackage::create($validated);
        
        return redirect()->route('travel.packages')->with('success', 'Paket perjalanan berhasil ditambahkan!');
    }

    public function updatePackage(Request $request, TravelPackage $package)
    {
        // Pastikan paket milik travel partner yang login
        if ($package->travel_partner_id !== auth()->user()->travelPartner->id) {
            abort(403, 'Unauthorized');
        }
    
        $validated = $request->validate([
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
            'agent_fee' => 'nullable|numeric|min:0',
            'agent_fee_type' => 'required_with:agent_fee|in:fixed,percentage',
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
    
        return redirect()->route('travel.packages')->with('success', 'Paket perjalanan berhasil diperbarui!');
    }

    public function editPackage(TravelPackage $package)
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if (!$travelPartner || $package->travel_partner_id !== $travelPartner->id) {
            abort(403, 'Unauthorized');
        }
    
        return view('travel.packages.edit', compact('package', 'travelPartner'));
    }

    public function destroyPackage(TravelPackage $package)
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if (!$travelPartner || $package->travel_partner_id !== $travelPartner->id) {
            abort(403, 'Unauthorized');
        }

        $package->delete();

        return redirect()->route('travel.packages')
            ->with('success', 'Paket travel berhasil dihapus.');
    }

    public function profile()
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();

        return view('travel.profile.show', compact('travelPartner'));
    }

    public function createProfile()
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if ($travelPartner) {
            return redirect()->route('travel.profile')
                ->with('info', 'Profil travel partner sudah ada.');
        }

        return view('travel.profile.create');
    }

    public function storeProfile(Request $request)
    {
        $user = Auth::user();
        $existingPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if ($existingPartner) {
            return redirect()->route('travel.profile')
                ->with('error', 'Profil travel partner sudah ada.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'ppiu_number' => 'nullable|string|max:100',
            'pihk_number' => 'nullable|string|max:100',
            'is_active' => 'boolean'
        ]);

        $validated['user_id'] = $user->id;
        $validated['is_active'] = $request->has('is_active');

        TravelPartner::create($validated);

        return redirect()->route('travel.dashboard')
            ->with('success', 'Profil travel partner berhasil dibuat.');
    }

    public function editProfile()
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if (!$travelPartner) {
            return redirect()->route('travel.profile.create')
                ->with('warning', 'Silakan buat profil travel partner terlebih dahulu.');
        }

        return view('travel.profile.edit', compact('travelPartner'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $travelPartner = TravelPartner::where('user_id', $user->id)->first();
        
        if (!$travelPartner) {
            return redirect()->route('travel.profile.create')
                ->with('error', 'Profil travel partner tidak ditemukan.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'ppiu_number' => 'nullable|string|max:100',
            'pihk_number' => 'nullable|string|max:100',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $travelPartner->update($validated);

        return redirect()->route('travel.profile')
            ->with('success', 'Profil travel partner berhasil diperbarui.');
    }
}