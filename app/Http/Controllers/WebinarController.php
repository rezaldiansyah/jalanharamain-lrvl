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

        return response()->json(['success' => true]);
    }
}