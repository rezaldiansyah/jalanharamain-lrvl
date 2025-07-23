<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelPartner;
use App\Models\TravelPackage;

class AdminController extends Controller
{
    // Hapus method __construct()
    
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
        $partners = TravelPartner::latest()->paginate(10);
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
            'is_active' => 'boolean',
        ]);

        TravelPartner::create($validated);
        
        return redirect()->route('admin.partners')->with('success', 'Travel partner berhasil ditambahkan!');
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
            'description' => 'required|string',
            'destination' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_participants' => 'required|integer|min:1',
            'itinerary' => 'nullable|string',
            'includes' => 'nullable|string',
            'excludes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        TravelPackage::create($validated);
        
        return redirect()->route('admin.packages')->with('success', 'Paket perjalanan berhasil ditambahkan!');
    }
}