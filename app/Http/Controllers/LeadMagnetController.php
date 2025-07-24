<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalagenEbook;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Cities;

class LeadMagnetController extends Controller
{
    public function registerEbook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'required|string|max:255',
            'kota_domisili' => 'required|string|max:255',
            'email' => 'required|email|unique:calagen_ebook,email|unique:users,email',
            'username' => 'required|string|max:255|unique:calagen_ebook,username|unique:users,email',
            'password' => 'required|string|min:6',
            'nomor_whatsapp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $calagenEbook = CalagenEbook::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nama_panggilan' => $request->nama_panggilan,
            'kota_domisili' => $request->kota_domisili,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nomor_whatsapp' => $request->nomor_whatsapp,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        // Otomatis convert ke user
        $calagenEbook->convertToUser();

        return redirect()->route('pendaftaran.agen')->with('success', 'Pendaftaran berhasil! Anda akan segera mendapatkan akses ke eBook gratis.');
    }

    public function showCalagenEbook()
    {
        $calagenEbooks = CalagenEbook::orderBy('created_at', 'desc')->get();
        return view('admin.lead-magnet.calagen-ebook', compact('calagenEbooks'));
    }

    public function showCalagenWebinar()
    {
        // Placeholder untuk calon agen webinar
        return view('admin.lead-magnet.calagen-webinar');
    }
}
