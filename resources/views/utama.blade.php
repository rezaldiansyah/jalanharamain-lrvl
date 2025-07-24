
@extends('layouts.app')

@section('content')

<style>
.hero {
    position: relative;
    height: 100vh;
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #4a90e2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.mosque-silhouette {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: 60%;
    z-index: 1;
    opacity: 0.3;
}

.stars {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, #fff, transparent),
        radial-gradient(2px 2px at 40px 70px, #fff, transparent),
        radial-gradient(1px 1px at 90px 40px, #fff, transparent),
        radial-gradient(1px 1px at 130px 80px, #fff, transparent),
        radial-gradient(2px 2px at 160px 30px, #fff, transparent);
    background-repeat: repeat;
    background-size: 200px 100px;
    animation: sparkle 3s linear infinite;
    z-index: 0;
}

@keyframes sparkle {
    0%, 100% { opacity: 0.8; }
    50% { opacity: 0.4; }
}

/* Mobile Navigation */
.mobile-nav {
    display: none;
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 5;
}

.hamburger {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 8px;
    padding: 10px;
    cursor: pointer;
    backdrop-filter: blur(10px);
}

.hamburger span {
    display: block;
    width: 25px;
    height: 3px;
    background: white;
    margin: 5px 0;
    transition: 0.3s;
    border-radius: 2px;
}

.mobile-menu {
    position: absolute;
    top: 60px;
    right: 0;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 15px;
    padding: 20px;
    min-width: 200px;
    transform: translateY(-20px);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.mobile-menu.active {
    transform: translateY(0);
    opacity: 1;
    visibility: visible;
}

.mobile-menu a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 0.9rem;
    text-transform: uppercase;
    transition: all 0.3s ease;
}

.mobile-menu a:last-child {
    border-bottom: none;
}

.mobile-menu a:hover {
    color: #ffa500;
    padding-left: 10px;
}

/* Desktop Navigation */
.desktop-nav {
    position: absolute;
    top: 20px;
    right: 30px;
    z-index: 4;
    display: flex;
    gap: 10px;
}

.nav-link {
    color: white;
    text-decoration: none;
    font-size: 0.95rem;
    text-transform: uppercase;
    transition: all 0.3s ease;
    padding: 8px 16px;
    border-radius: 25px;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    white-space: nowrap;
}

.nav-link:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-1px);
}

.hero-content {
    position: relative;
    text-align: center;
    color: white;
    z-index: 3;
    max-width: 800px;
    padding: 2rem;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin: 0 1rem;
}

.hero h1 {
    font-size: 3.5rem;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    font-weight: 700;
    background: linear-gradient(45deg, #fff, #f0f8ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.hero p {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    font-weight: 300;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    line-height: 1.6;
}

.cta-button {
    background: linear-gradient(45deg, #ff6b6b, #ffa500);
    color: white;
    border: none;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    border-radius: 50px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
}

/* Responsive Design */
@media (max-width: 768px) {
    .desktop-nav {
        display: none;
    }
    
    .mobile-nav {
        display: block;
    }
    
    .hero-content {
        padding: 1.5rem;
        margin: 0 0.5rem;
    }
    
    .hero h1 {
        font-size: 2.5rem;
        line-height: 1.1;
    }
    
    .hero p {
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }
    
    .cta-button {
        padding: 12px 24px;
        font-size: 1rem;
    }
    
    .mosque-silhouette {
        height: 50%;
    }
}

@media (max-width: 480px) {
    .hero-content {
        padding: 1rem;
        margin: 0 0.25rem;
    }
    
    .hero h1 {
        font-size: 2rem;
    }
    
    .hero p {
        font-size: 1rem;
    }
    
    .cta-button {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
}

/* Section Responsive */
@media (max-width: 768px) {
    section {
        padding: 2rem 1rem !important;
    }
    
    h2 {
        font-size: 1.8rem !important;
    }
    
    .grid-container {
        grid-template-columns: 1fr !important;
        gap: 1rem !important;
    }
    
    .card {
        padding: 1.5rem !important;
    }
}

@media (max-width: 480px) {
    section {
        padding: 1.5rem 0.5rem !important;
    }
    
    h2 {
        font-size: 1.5rem !important;
    }
    
    .card {
        padding: 1rem !important;
    }
    
    form {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    
    form input {
        min-width: auto !important;
        margin-bottom: 10px;
    }
}
</style>

<!-- Section 1: Hero -->
<div class="hero">
    <!-- Stars Background -->
    <div class="stars"></div>
    
    <!-- Mosque Silhouette SVG -->
    <div class="mosque-silhouette">
        <svg viewBox="0 0 800 400" xmlns="http://www.w3.org/2000/svg">
            <!-- Main Mosque Structure -->
            <rect x="200" y="250" width="400" height="150" fill="#000" opacity="0.6"/>
            
            <!-- Central Dome -->
            <ellipse cx="400" cy="250" rx="80" ry="60" fill="#000" opacity="0.6"/>
            
            <!-- Side Domes -->
            <ellipse cx="280" cy="270" rx="40" ry="30" fill="#000" opacity="0.6"/>
            <ellipse cx="520" cy="270" rx="40" ry="30" fill="#000" opacity="0.6"/>
            
            <!-- Minarets -->
            <rect x="150" y="100" width="20" height="200" fill="#000" opacity="0.6"/>
            <rect x="630" y="100" width="20" height="200" fill="#000" opacity="0.6"/>
            <rect x="320" y="120" width="15" height="150" fill="#000" opacity="0.6"/>
            <rect x="465" y="120" width="15" height="150" fill="#000" opacity="0.6"/>
            
            <!-- Minaret Tops -->
            <ellipse cx="160" cy="100" rx="15" ry="20" fill="#000" opacity="0.6"/>
            <ellipse cx="640" cy="100" rx="15" ry="20" fill="#000" opacity="0.6"/>
            <ellipse cx="327" cy="120" rx="12" ry="15" fill="#000" opacity="0.6"/>
            <ellipse cx="472" cy="120" rx="12" ry="15" fill="#000" opacity="0.6"/>
            
            <!-- Crescents on Minarets -->
            <path d="M 155 85 Q 160 80 165 85 Q 160 90 155 85" fill="#000" opacity="0.6"/>
            <path d="M 635 85 Q 640 80 645 85 Q 640 90 635 85" fill="#000" opacity="0.6"/>
            <path d="M 322 105 Q 327 100 332 105 Q 327 110 322 105" fill="#000" opacity="0.6"/>
            <path d="M 467 105 Q 472 100 477 105 Q 472 110 467 105" fill="#000" opacity="0.6"/>
            
            <!-- Main Entrance Arch -->
            <path d="M 350 400 Q 350 300 400 300 Q 450 300 450 400 Z" fill="#000" opacity="0.4"/>
            
            <!-- Side Arches -->
            <path d="M 220 400 Q 220 320 250 320 Q 280 320 280 400 Z" fill="#000" opacity="0.4"/>
            <path d="M 520 400 Q 520 320 550 320 Q 580 320 580 400 Z" fill="#000" opacity="0.4"/>
        </svg>
    </div>
    
    <!-- Desktop Navigation -->
    <nav class="desktop-nav">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
        <a href="#" class="nav-link">Paket Umroh</a>
        <a href="#" class="nav-link">Wisata Halal</a>
        <a href="{{ route('pendaftaran.agen') }}" class="nav-link">Daftar Agen</a>
        <a href="{{ route('login') }}" class="nav-link">Login</a>
    </nav>
    
    <!-- Mobile Navigation -->
    <div class="mobile-nav">
        <div class="hamburger" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="mobile-menu" id="mobileMenu">
            <a href="{{ route('home') }}">Home</a>
            <a href="#">Paket Umroh</a>
            <a href="#">Wisata Halal</a>
            <a href="{{ route('pendaftaran.agen') }}">Daftar Agen</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
    
    <div class="hero-content">
        <h1>Temukan Jalan Menuju Haramain</h1>
        <p>Platform modern untuk perjalanan Umroh & wisata halal dari seluruh Indonesia. Wujudkan impian spiritual Anda bersama kami.</p>
        <button class="cta-button">Jelajahi Sekarang</button>
    </div>
</div>

<!-- Section 2: Tentang Kami -->
<section style="padding: 4rem 2rem; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
  <div style="max-width: 900px; margin: auto; text-align: center;">
    <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: #2c3e50; font-weight: 600;">Apa Misi JalanHaramain?</h2>
    <p style="font-size: 1.2rem; color: #555; line-height: 1.8; margin-bottom: 2rem;">
      JalanHaramain hadir sebagai jembatan perjalanan spiritual dan halal ke Tanah Suci dan destinasi muslim-friendly dunia.
      Kami percaya bahwa setiap perjalanan Umroh dan wisata halal harus dirancang dengan ketenangan hati, kejelasan tujuan, dan pelayanan profesional dari awal hingga kembali ke rumah.
    </p>
    <p style="margin-top: 2rem;">
      <a href="#" style="background: linear-gradient(45deg, #2c3e50, #34495e); color: white; padding: 15px 30px; text-decoration: none; border-radius: 50px; transition: all 0.3s ease; display: inline-block; font-weight: 600;">Pelajari Lebih Lanjut</a>
    </p>
  </div>
</section>

<!-- Section 3: Mengapa JalanHaramain -->
<section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 4rem 1rem; color: white;">
  <div style="max-width: 1000px; margin: auto;">
    <h2 style="text-align: center; font-size: 2.2rem; margin-bottom: 3rem; font-weight: 600;">Mengapa JalanHaramain?</h2>
    <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
      <div class="card" style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); text-align: center;">
        <h4 style="font-size: 1.3rem; margin-bottom: 1rem; color: #fff;">Layanan Konsultasi Gratis</h4>
        <p style="line-height: 1.6;">Kami bantu Anda memilih paket terbaik tanpa tekanan.</p>
      </div>
      <div class="card" style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); text-align: center;">
        <h4 style="font-size: 1.3rem; margin-bottom: 1rem; color: #fff;">Harga Transparan</h4>
        <p style="line-height: 1.6;">Tanpa biaya tersembunyi. Semua jelas sejak awal.</p>
      </div>
      <div class="card" style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); text-align: center;">
        <h4 style="font-size: 1.3rem; margin-bottom: 1rem; color: #fff;">Dukungan 24/7</h4>
        <p style="line-height: 1.6;">Kami siap membantu Anda sebelum, saat, dan setelah perjalanan.</p>
      </div>
      <div class="card" style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); text-align: center;">
        <h4 style="font-size: 1.3rem; margin-bottom: 1rem; color: #fff;">Dipandu Agen Berpengalaman</h4>
        <p style="line-height: 1.6;">Didampingi oleh tim yang pernah melayani ribuan jamaah.</p>
      </div>
    </div>
  </div>
</section>

<!-- Section 4: Testimoni -->
<section style="padding: 4rem 1.5rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
  <div style="max-width: 1000px; margin: auto; text-align: center;">
    <h2 style="font-size: 2.2rem; margin-bottom: 3rem; font-weight: 600;">Cerita Mereka yang Telah Berangkat</h2>
    <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
      <div class="card" style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
        <blockquote style="font-style: italic; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem;">"Sungguh perjalanan Umroh yang berkesan dan tanpa rasa khawatir. Terima kasih tim JalanHaramain!"</blockquote>
        <p style="font-weight: 600; color: #fff;">Ahmad, Jakarta</p>
      </div>
      <div class="card" style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
        <blockquote style="font-style: italic; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem;">"Paket wisata halalnya lengkap, panduan restorannya juga membantu banget saat ke Turki."</blockquote>
        <p style="font-weight: 600; color: #fff;">Siti, Surabaya</p>
      </div>
    </div>
  </div>
</section>

<!-- Section 5: CTA Subscription -->
<section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 4rem 1.5rem; text-align: center; color: white;">
  <h2 style="font-size: 2.2rem; margin-bottom: 1rem; font-weight: 600;">Siap Memulai Perjalanan Spiritual Anda?</h2>
  <p style="margin-bottom: 2rem; font-size: 1.1rem; line-height: 1.6;">Daftar dan dapatkan informasi terbaru tentang promo, paket baru, dan inspirasi perjalanan halal.</p>
  <form style="max-width: 500px; margin: auto; display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
    <input type="email" placeholder="Masukkan email Anda" style="padding: 15px 20px; flex: 1; min-width: 250px; border: none; border-radius: 50px; font-size: 1rem;" required />
    <button type="submit" style="padding: 15px 30px; background: linear-gradient(45deg, #ff6b6b, #ffa500); color: white; border: none; border-radius: 50px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">Berlangganan</button>
  </form>
</section>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('active');
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileNav = document.querySelector('.mobile-nav');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (!mobileNav.contains(event.target)) {
        mobileMenu.classList.remove('active');
    }
});

// Close mobile menu when window is resized to desktop
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        document.getElementById('mobileMenu').classList.remove('active');
    }
});
</script>

@endsection
