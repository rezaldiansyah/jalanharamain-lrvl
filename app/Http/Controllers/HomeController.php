<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelPackage;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil paket berdasarkan kategori
        $umrohPackages = TravelPackage::with('travelPartner')
            ->where('is_active', true)
            ->where(function($query) {
                $query->where('name', 'like', '%umroh%')
                      ->orWhere('destination', 'like', '%makkah%')
                      ->orWhere('destination', 'like', '%madinah%');
            })
            ->limit(3)
            ->get();
            
        $wisataHalalPackages = TravelPackage::with('travelPartner')
            ->where('is_active', true)
            ->where(function($query) {
                $query->where('name', 'like', '%wisata%')
                      ->orWhere('name', 'like', '%halal%')
                      ->orWhere('destination', 'not like', '%makkah%')
                      ->where('destination', 'not like', '%madinah%');
            })
            ->limit(3)
            ->get();
    
        $popularPackages = $umrohPackages->merge($wisataHalalPackages);
    
        return view('utama', compact('popularPackages'));
    }
}