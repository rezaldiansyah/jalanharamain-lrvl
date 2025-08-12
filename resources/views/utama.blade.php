
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
}

/* Header Navigation - Inspired by Expedia */
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
}

.nav-link:hover {
    background: #f3f4f5;
    color: #374da0;
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
    transform: translateY(-1px);
}

/* Hero Section - Inspired by Kayak */
.hero-section {
    background: linear-gradient(135deg, #374da0 0%, #327eac 50%, #2cbbbc 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    padding-top: 70px;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="mosque" x="0" y="0" width="200" height="200" patternUnits="userSpaceOnUse"><path d="M50 150 Q50 100 100 100 Q150 100 150 150 Z" fill="%23ffffff" opacity="0.05"/><rect x="80" y="50" width="40" height="100" fill="%23ffffff" opacity="0.05"/><circle cx="100" cy="50" r="15" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100%25" height="100%25" fill="url(%23mosque)"/></svg>');
    opacity: 0.3;
}

.hero-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    text-align: center;
    position: relative;
    z-index: 2;
}

.hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: 3.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-family: 'Ubuntu', sans-serif;
    font-size: 1.3rem;
    font-weight: 400;
    color: white;
    margin-bottom: 3rem;
    opacity: 0.9;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Search Box - Kayak Style */
.search-container {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    max-width: 800px;
    margin: 0 auto;
}

.search-tabs {
    display: flex;
    gap: 0;
    margin-bottom: 25px;
    border-radius: 8px;
    overflow: hidden;
    background: #f3f4f5;
}

.search-tab {
    flex: 1;
    padding: 12px 20px;
    background: transparent;
    border: none;
    font-family: 'Ubuntu', sans-serif;
    font-weight: 500;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-tab.active {
    background: #374da0;
    color: white;
}

.search-form {
    display: grid;
    grid-template-columns: 2fr 2fr 1fr 1fr;
    gap: 15px;
    align-items: end;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-family: 'Ubuntu', sans-serif;
    font-weight: 500;
    color: #333;
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.form-input {
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-family: 'Ubuntu', sans-serif;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #374da0;
    box-shadow: 0 0 0 3px rgba(55, 77, 160, 0.1);
}

.search-btn {
    background: linear-gradient(135deg, #2cbbbc 0%, #327eac 100%);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 6px;
    font-family: 'Ubuntu', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    height: fit-content;
}

.search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(44, 187, 188, 0.3);
}

/* Features Section - Expedia Style */
.features-section {
    padding: 80px 0;
    background: #f3f4f5;
}

.features-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-title {
    font-family: 'Poppins', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: #374da0;
    text-align: center;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-family: 'Ubuntu', sans-serif;
    font-size: 1.1rem;
    color: #666;
    text-align: center;
    margin-bottom: 50px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.feature-card {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    text-align: center;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #2cbbbc 0%, #327eac 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
}

.feature-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.3rem;
    font-weight: 600;
    color: #374da0;
    margin-bottom: 10px;
}

.feature-description {
    font-family: 'Ubuntu', sans-serif;
    color: #666;
    line-height: 1.6;
}

/* Packages Section */
.packages-section {
    padding: 80px 0;
    background: white;
}

.packages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.package-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.package-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.package-image {
    height: 200px;
    background: linear-gradient(135deg, #374da0 0%, #2cbbbc 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
}

.package-content {
    padding: 25px;
}

.package-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.4rem;
    font-weight: 600;
    color: #374da0;
    margin-bottom: 10px;
}

.package-price {
    font-family: 'Ubuntu', sans-serif;
    font-size: 1.8rem;
    font-weight: 700;
    color: #2cbbbc;
    margin-bottom: 15px;
}

.package-features {
    list-style: none;
    margin-bottom: 20px;
}

.package-features li {
    font-family: 'Ubuntu', sans-serif;
    color: #666;
    margin-bottom: 8px;
    padding-left: 20px;
    position: relative;
}

.package-features li:before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #2cbbbc;
    font-weight: bold;
}

.package-btn {
    width: 100%;
    background: #374da0;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 6px;
    font-family: 'Ubuntu', sans-serif;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.package-btn:hover {
    background: #2a3a7a;
}

/* Testimonials */
.testimonials-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #374da0 0%, #327eac 100%);
    color: white;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.testimonial-card {
    background: rgba(255,255,255,0.1);
    padding: 30px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

.testimonial-text {
    font-family: 'Ubuntu', sans-serif;
    font-style: italic;
    margin-bottom: 20px;
    line-height: 1.6;
}

.testimonial-author {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

/* CTA Section */
.cta-section {
    padding: 80px 0;
    background: #2cbbbc;
    text-align: center;
    color: white;
}

.cta-title {
    font-family: 'Poppins', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.cta-subtitle {
    font-family: 'Ubuntu', sans-serif;
    font-size: 1.2rem;
    margin-bottom: 30px;
    opacity: 0.9;
}

.cta-form {
    max-width: 500px;
    margin: 0 auto;
    display: flex;
    gap: 15px;
}

.cta-input {
    flex: 1;
    padding: 15px 20px;
    border: none;
    border-radius: 6px;
    font-family: 'Ubuntu', sans-serif;
    font-size: 1rem;
}

.cta-btn {
    background: #374da0;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 6px;
    font-family: 'Ubuntu', sans-serif;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.cta-btn:hover {
    background: #2a3a7a;
}

/* Mobile Navigation */
.mobile-nav {
    display: none;
}

.hamburger {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
}

.hamburger span {
    display: block;
    width: 25px;
    height: 3px;
    background: #374da0;
    margin: 5px 0;
    transition: 0.3s;
    border-radius: 2px;
}

.mobile-menu {
    position: absolute;
    top: 70px;
    left: 0;
    right: 0;
    background: white;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transform: translateY(-100%);
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
    padding: 15px 20px;
    color: #333;
    text-decoration: none;
    border-bottom: 1px solid #f3f4f5;
    font-family: 'Ubuntu', sans-serif;
    font-weight: 500;
}

.mobile-menu a:hover {
    background: #f3f4f5;
    color: #374da0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .main-nav {
        display: none;
    }
    
    .mobile-nav {
        display: block;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .search-form {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .search-tabs {
        flex-direction: column;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .cta-form {
        flex-direction: column;
    }
    
    .packages-grid,
    .features-grid,
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .header-container {
        padding: 0 15px;
    }
    
    .hero-container {
        padding: 0 15px;
    }
    
    .search-container {
        margin: 0 15px;
        padding: 20px;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 1.8rem;
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
            <a href="{{ route('pendaftaran.agen') }}" class="nav-link">Daftar Agen</a>
            <a href="{{ route('login') }}" class="nav-link login-btn">Masuk</a>
        </nav>
        
        <!-- Mobile Navigation -->
        <div class="mobile-nav">
            <button class="hamburger" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="mobile-menu" id="mobileMenu">
                <a href="{{ route('home') }}">Beranda</a>
                <a href="#">Paket Umroh</a>
                <a href="#">Wisata Halal</a>
                <a href="{{ route('pendaftaran.agen') }}">Daftar Agen</a>
                <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-background"></div>
    <div class="hero-container">
        <h1 class="hero-title">Temukan Jalan Menuju Haramain</h1>
        <p class="hero-subtitle">Platform terpercaya untuk perjalanan Umroh & wisata halal. Wujudkan impian spiritual Anda dengan pelayanan terbaik.</p>
        
        <!-- Search Box -->
        <div class="search-container">
            <div class="search-tabs">
                <button class="search-tab active" onclick="switchTab('umroh')">Paket Umroh</button>
                <button class="search-tab" onclick="switchTab('wisata')">Wisata Halal</button>
                <button class="search-tab" onclick="switchTab('hotel')">Hotel</button>
            </div>
            
            <form class="search-form" id="searchForm">
                <div class="form-group">
                    <label class="form-label">Tujuan</label>
                    <input type="text" class="form-input" placeholder="Makkah, Madinah, Istanbul..." required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Keberangkatan</label>
                    <input type="date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Durasi</label>
                    <select class="form-input" required>
                        <option value="">Pilih Durasi</option>
                        <option value="9">9 Hari</option>
                        <option value="12">12 Hari</option>
                        <option value="15">15 Hari</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Jamaah</label>
                    <select class="form-input" required>
                        <option value="">Jumlah</option>
                        <option value="1">1 Orang</option>
                        <option value="2">2 Orang</option>
                        <option value="3">3 Orang</option>
                        <option value="4+">4+ Orang</option>
                    </select>
                </div>
                <button type="submit" class="search-btn">Cari Paket</button>
            </form>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="features-container">
        <h2 class="section-title">Mengapa Memilih JalanHaramain?</h2>
        <p class="section-subtitle">Kami berkomitmen memberikan pengalaman perjalanan spiritual terbaik dengan layanan profesional dan terpercaya.</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🕌</div>
                <h3 class="feature-title">Paket Lengkap</h3>
                <p class="feature-description">Paket all-inclusive dengan akomodasi, transportasi, makan, dan panduan spiritual yang komprehensif.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3 class="feature-title">Harga Transparan</h3>
                <p class="feature-description">Tidak ada biaya tersembunyi. Semua detail biaya dijelaskan dengan jelas sejak awal.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3 class="feature-title">Pembimbing Berpengalaman</h3>
                <p class="feature-description">Didampingi oleh pembimbing yang berpengalaman dan memahami kebutuhan jamaah Indonesia.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🛡️</div>
                <h3 class="feature-title">Jaminan Keamanan</h3>
                <p class="feature-description">Perjalanan yang aman dengan asuransi perjalanan dan dukungan 24/7 selama di Tanah Suci.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3 class="feature-title">Teknologi Modern</h3>
                <p class="feature-description">Platform digital untuk memudahkan booking, tracking, dan komunikasi dengan tim support.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⭐</div>
                <h3 class="feature-title">Layanan Premium</h3>
                <p class="feature-description">Pelayanan berkualitas tinggi dengan fasilitas terbaik untuk kenyamanan perjalanan Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- Packages Section -->
<section class="packages-section">
    <div class="features-container">
        <h2 class="section-title">Paket Populer</h2>
        <p class="section-subtitle">Pilihan paket terbaik yang telah dipercaya oleh ribuan jamaah dari seluruh Indonesia.</p>
        
        <div class="packages-grid">
            <div class="package-card">
                <div class="package-image">🕌</div>
                <div class="package-content">
                    <h3 class="package-title">Umroh Ekonomis 9 Hari</h3>
                    <div class="package-price">Rp 25.000.000</div>
                    <ul class="package-features">
                        <li>Hotel bintang 3 di Makkah & Madinah</li>
                        <li>Transportasi AC selama di Arab Saudi</li>
                        <li>Makan 3x sehari</li>
                        <li>Pembimbing berpengalaman</li>
                        <li>Visa & handling</li>
                    </ul>
                    <button class="package-btn">Pilih Paket</button>
                </div>
            </div>
            
            <div class="package-card">
                <div class="package-image">⭐</div>
                <div class="package-content">
                    <h3 class="package-title">Umroh VIP 12 Hari</h3>
                    <div class="package-price">Rp 45.000.000</div>
                    <ul class="package-features">
                        <li>Hotel bintang 5 dekat Haram</li>
                        <li>Transportasi VIP</li>
                        <li>Buffet premium</li>
                        <li>City tour Madinah</li>
                        <li>Ziarah lengkap</li>
                    </ul>
                    <button class="package-btn">Pilih Paket</button>
                </div>
            </div>
            
            <div class="package-card">
                <div class="package-image">🌍</div>
                <div class="package-content">
                    <h3 class="package-title">Wisata Halal Turki</h3>
                    <div class="package-price">Rp 35.000.000</div>
                    <ul class="package-features">
                        <li>Istanbul, Cappadocia, Pamukkale</li>
                        <li>Hotel halal bintang 4</li>
                        <li>Makanan halal terjamin</li>
                        <li>Panduan wisata muslim</li>
                        <li>Shopping tour</li>
                    </ul>
                    <button class="package-btn">Pilih Paket</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="features-container">
        <h2 class="section-title" style="color: white;">Testimoni Jamaah</h2>
        <p class="section-subtitle" style="color: rgba(255,255,255,0.9);">Pengalaman nyata dari jamaah yang telah mempercayakan perjalanan spiritual mereka kepada kami.</p>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <p class="testimonial-text">"Alhamdulillah, perjalanan Umroh dengan JalanHaramain sangat berkesan. Pelayanan yang ramah dan profesional membuat ibadah kami khusyuk."</p>
                <p class="testimonial-author">- Ahmad Fauzi, Jakarta</p>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">"Hotel dekat Haram, makanan enak, dan pembimbing yang sabar. Terima kasih JalanHaramain atas pengalaman spiritual yang luar biasa."</p>
                <p class="testimonial-author">- Siti Nurhaliza, Surabaya</p>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">"Paket wisata halal Turki sangat memuaskan. Semua tempat yang dikunjungi sesuai dengan nilai-nilai Islam. Highly recommended!"</p>
                <p class="testimonial-author">- Budi Santoso, Bandung</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="features-container">
        <h2 class="cta-title">Siap Memulai Perjalanan Spiritual?</h2>
        <p class="cta-subtitle">Daftar sekarang dan dapatkan informasi terbaru tentang promo menarik dan paket perjalanan terbaru.</p>
        
        <form class="cta-form">
            <input type="email" class="cta-input" placeholder="Masukkan email Anda" required>
            <button type="submit" class="cta-btn">Berlangganan</button>
        </form>
    </div>
</section>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('active');
}

function switchTab(tabType) {
    // Remove active class from all tabs
    document.querySelectorAll('.search-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Add active class to clicked tab
    event.target.classList.add('active');
    
    // You can add logic here to change form fields based on tab type
    console.log('Switched to:', tabType);
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileNav = document.querySelector('.mobile-nav');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (!mobileNav.contains(event.target)) {
        mobileMenu.classList.remove('active');
    }
});

// Header scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.main-header');
    if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.backdropFilter = 'blur(10px)';
    } else {
        header.style.background = '#ffffff';
        header.style.backdropFilter = 'none';
    }
});

// Form submission
document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Fitur pencarian akan segera tersedia!');
});
</script>

@endsection
