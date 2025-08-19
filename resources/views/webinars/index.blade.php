@extends('layouts.app')

@section('content')
<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Ubuntu', sans-serif;
    line-height: 1.6;
    color: #333;
    background: #f8f9fa;
}

/* Header Navigation */
.main-header {
    background: #ffffff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    transition: all 0.3s ease;
}

.header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 70px;
}

.logo {
    font-family: 'Poppins', sans-serif;
    font-size: 1.8rem;
    font-weight: 700;
    color: #374da0;
    text-decoration: none;
}

.main-nav {
    display: flex;
    gap: 30px;
    align-items: center;
}

.nav-link {
    font-family: 'Ubuntu', sans-serif;
    font-weight: 500;
    color: #333;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link:hover {
    background: #f3f4f5;
    color: #374da0;
}

/* Dropdown Menu */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    border-radius: 6px;
    z-index: 1;
    top: 100%;
    left: 0;
}

.dropdown-content a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-weight: 400;
}

.dropdown-content a:hover {
    background-color: #f3f4f5;
    color: #374da0;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.login-btn {
    background: #374da0;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.login-btn:hover {
    background: #2a3a7a;
    color: white;
}

/* Main Content */
.main-content {
    margin-top: 70px;
    padding: 40px 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

.page-header {
    text-align: center;
    margin-bottom: 40px;
}

.page-title {
    font-family: 'Poppins', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: #374da0;
    margin-bottom: 10px;
}

.page-subtitle {
    font-size: 1.1rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

/* Webinar Grid */
.webinars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.webinar-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.webinar-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.webinar-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    text-align: center;
}

.webinar-date {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-bottom: 5px;
}

.webinar-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.4;
}

.webinar-time {
    font-size: 0.9rem;
    opacity: 0.9;
}

.webinar-body {
    padding: 20px;
}

.webinar-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

.webinar-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.webinar-price {
    font-weight: 600;
    color: #28a745;
}

.webinar-platform {
    font-size: 0.9rem;
    color: #666;
}

.webinar-btn {
    display: block;
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-align: center;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.webinar-btn:hover {
    transform: scale(1.02);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
}

.no-webinars {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.no-webinars h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #374da0;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .main-nav {
        display: none;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .webinars-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .webinar-meta {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
}
</style>

<!-- Header Navigation -->
<header class="main-header">
    <div class="header-container">
        <a href="{{ route('home') }}" class="logo">JalanHaramain</a>
        
        <!-- Desktop Navigation -->
        <nav class="main-nav">
            <a href="{{ route('home') }}" class="nav-link">Beranda</a>
            <a href="#" class="nav-link">Paket Umroh</a>
            <a href="#" class="nav-link">Wisata Halal</a>
            
            <!-- Event Dropdown Menu -->
            <div class="dropdown">
                <a href="#" class="nav-link">Event</a>
                <div class="dropdown-content">
                    <a href="{{ route('webinars.index') }}">Webinar</a>
                </div>
            </div>
            
            <a href="{{ route('pendaftaran.agen') }}" class="nav-link">Daftar Agen</a>
            <a href="{{ route('login') }}" class="nav-link login-btn">Masuk</a>
        </nav>
    </div>
</header>

<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Webinar Gratis</h1>
            <p class="page-subtitle">
                Ikuti webinar gratis kami dan pelajari cara menjadi Tour Leader Umroh profesional. 
                Dapatkan penghasilan sambil beribadah ke Tanah Suci.
            </p>
        </div>
        
        @if($webinars->count() > 0)
            <div class="webinars-grid">
                @foreach($webinars as $webinar)
                    <div class="webinar-card">
                        <div class="webinar-header">
                            <div class="webinar-date">
                                {{ \Carbon\Carbon::parse($webinar->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                            </div>
                            <h3 class="webinar-title">{{ $webinar->title }}</h3>
                            @if($webinar->subtitle)
                                <p class="webinar-time">{{ $webinar->subtitle }}</p>
                            @endif
                            <div class="webinar-time">
                                📅 {{ \Carbon\Carbon::parse($webinar->time)->format('H:i') }} WIB
                            </div>
                        </div>
                        
                        <div class="webinar-body">
                            <p class="webinar-description">
                                {{ Str::limit($webinar->description, 150) }}
                            </p>
                            
                            <div class="webinar-meta">
                                <div class="webinar-price">
                                    @if($webinar->is_free)
                                        🎉 GRATIS
                                    @else
                                        Rp {{ number_format($webinar->price, 0, ',', '.') }}
                                    @endif
                                </div>
                                <div class="webinar-platform">
                                    📍 {{ $webinar->platform }}
                                </div>
                            </div>
                            
                            <a href="{{ $webinar->getPublicUrl() }}" class="webinar-btn">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-webinars">
                <h3>🎯 Belum Ada Webinar</h3>
                <p>Saat ini belum ada webinar yang dijadwalkan dalam 3 bulan ke depan.</p>
                <p>Pantau terus halaman ini untuk update webinar terbaru!</p>
            </div>
        @endif
    </div>
</main>
@endsection