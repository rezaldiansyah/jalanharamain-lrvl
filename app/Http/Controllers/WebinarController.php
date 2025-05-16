<?php

namespace App\Http\Controllers;

use App\Models\WebinarRegistration;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|min:10',
            'city' => 'required|string',
            'other_city' => 'required_if:city,other',
            'source' => 'required|string',
        ]);

        $registration = WebinarRegistration::create([
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