<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CalagenEbook;

class AgenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->canAccessEbook()) {
                abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $user = Auth::user();
        return view('agen.dashboard', compact('user'));
    }

    public function ebookGratis()
    {
        $user = Auth::user();
        
        // Cek apakah user sudah terdaftar di calagen_ebook
        $calagenEbook = CalagenEbook::where('email', $user->email)->first();
        
        return view('agen.ebook-gratis', compact('user', 'calagenEbook'));
    }
}