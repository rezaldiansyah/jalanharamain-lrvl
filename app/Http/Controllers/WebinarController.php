<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use App\Models\WebinarRegistration;
use App\Helpers\Cities;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function showBySlug($type, $date)
    {
        // Buat slug dari parameter
        $slug = "webinar/{$type}/{$date}";
        
        // Cari webinar berdasarkan slug
        $webinar = Webinar::where('slug', $slug)->firstOrFail();
        $cities = Cities::getIndonesianCities();
        
        // Load template berdasarkan pilihan admin
        $template = $webinar->template;
        
        return view($template, compact('webinar', 'cities'));
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'webinar_id' => 'required|exists:webinars,id',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|min:10',
            'city' => 'required|string',
            'other_city' => 'required_if:city,other',
            'source' => 'required|string',
        ]);
    
        $registration = WebinarRegistration::create([
            'webinar_id' => $validated['webinar_id'],
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'whatsapp' => $validated['whatsapp'],
            'city' => $validated['city'] === 'other' ? $validated['other_city'] : $validated['city'],
            'source' => $validated['source'],
        ]);
    
        // Ambil webinar untuk mendapatkan community_link
        $webinar = Webinar::find($validated['webinar_id']);
        
        $response = ['success' => true];
        
        // Jika ada community_link, kirim ke frontend
        if ($webinar && $webinar->community_link) {
            $response['redirect_url'] = $webinar->community_link;
        }
    
        return response()->json($response);
    }
    
    public function index()
    {
        // Ambil webinar yang akan diselenggarakan dalam 3 bulan ke depan
        $webinars = Webinar::where('status', 'published')
            ->where('date', '>=', now())
            ->where('date', '<=', now()->addMonths(3))
            ->orderBy('date', 'asc')
            ->get();
            
        return view('webinars.index', compact('webinars'));
    }
}