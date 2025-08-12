<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ebook;

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
        $user = auth()->user();
        
        // Cek akses berdasarkan role
        if (!$user->canAccessEbook()) {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }

        // Ambil e-book gratis yang aktif
        $ebooks = Ebook::active()->gratis()->latest()->get();
        
        return view('agen.ebook-gratis', compact('ebooks'));
    }

    public function viewEbook(Ebook $ebook)
    {
        // Fix corrupted URL if needed
        if (str_contains($ebook->bunny_url, '`') || str_contains($ebook->bunny_url, 'https://https://')) {
            $bunnyService = new \App\Services\BunnyService();
            $fixedUrl = $bunnyService->fixCorruptedUrl($ebook->bunny_url);
            
            if ($fixedUrl) {
                // Update database with fixed URL
                $ebook->update(['bunny_url' => $fixedUrl]);
                $ebook->refresh();
            }
        }
        
        return view('agen.view-ebook', compact('ebook'));
    }

    public function ebookProxy(Ebook $ebook)
    {
        try {
            // Clean the bunny_url from backticks and extra spaces
            $cleanUrl = trim(str_replace(['`', ' '], ['', ''], $ebook->bunny_url));
            
            // Get PDF content from BunnyCDN
            $pdfContent = file_get_contents($cleanUrl);
            
            if ($pdfContent === false) {
                abort(404, 'PDF not found');
            }
            
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="' . $ebook->title . '.pdf"')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
                
        } catch (Exception $e) {
            abort(500, 'Error loading PDF: ' . $e->getMessage());
        }
    }
}