
@extends('layouts.app')

@section('content')

<!-- Section 1: Hero -->
<div class="hero" style="position: relative; height: 100vh; background: url('https://source.unsplash.com/1600x900/?mecca,travel') center/cover no-repeat; display: flex; align-items: center; justify-content: center;">
    <div class="overlay" style="position: absolute; inset: 0; background-color: rgba(0,0,0,0.4);"></div>
    <nav style="position: absolute; top: 20px; right: 30px; z-index: 3;">
        <a href="{{ route('home') }}" style="color: white; margin-left: 20px; text-decoration: none; font-size: 0.95rem; text-transform: uppercase;">Home</a>
        <a href="#" style="color: white; margin-left: 20px; text-decoration: none; font-size: 0.95rem; text-transform: uppercase;">Paket Umroh</a>
        <a href="#" style="color: white; margin-left: 20px; text-decoration: none; font-size: 0.95rem; text-transform: uppercase;">Wisata Halal</a>
        <a href="{{ route('pendaftaran.agen') }}" style="color: white; margin-left: 20px; text-decoration: none; font-size: 0.95rem; text-transform: uppercase;">Daftar Agen</a>
        <a href="{{ route('login') }}" style="color: white; margin-left: 20px; text-decoration: none; font-size: 0.95rem; text-transform: uppercase;">Login Admin</a>
    </nav>
    <div class="hero-content" style="position: relative; text-align: center; color: white; z-index: 2; max-width: 800px; padding: 1rem;">
        <h1 style="font-size: 3rem; margin-bottom: 1rem;">Temukan Jalan Menuju Haramain</h1>
        <p style="font-size: 1.2rem; margin-bottom: 2rem; font-weight: 300;">Platform modern untuk perjalanan Umroh & wisata halal dari seluruh Indonesia.</p>
        <button style="background-color: #fff; color: #000; border: none; padding: 12px 24px; font-size: 1rem; font-weight: bold; cursor: pointer;">Jelajahi Sekarang</button>
    </div>
</div>

<!-- Section 2: Tentang Kami -->
<section style="padding: 4rem 2rem; background-color: #fffdf7;">
  <div style="max-width: 900px; margin: auto; text-align: center;">
    <h2 style="font-size: 2rem; margin-bottom: 1rem;">Apa Misi JalanHaramain?</h2>
    <p style="font-size: 1.1rem; color: #444; line-height: 1.7;">
      JalanHaramain hadir sebagai jembatan perjalanan spiritual dan halal ke Tanah Suci dan destinasi muslim-friendly dunia.
      Kami percaya bahwa setiap perjalanan Umroh dan wisata halal harus dirancang dengan ketenangan hati, kejelasan tujuan, dan pelayanan profesional dari awal hingga kembali ke rumah.
    </p>
    <p style="margin-top: 2rem;">
      <a href="#" style="background-color: #000; color: white; padding: 12px 24px; text-decoration: none;">Pelajari Lebih Lanjut</a>
    </p>
  </div>
</section>

<!-- Section 3: Mengapa JalanHaramain -->
<section style="background-color: #f4f0e8; padding: 3rem 1rem;">
  <div style="max-width: 1000px; margin: auto;">
    <h2 style="text-align: center; font-size: 1.8rem; margin-bottom: 2rem;">Mengapa JalanHaramain?</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center;">
      <div style="flex: 1; min-width: 200px;">
        <h4>Layanan Konsultasi Gratis</h4>
        <p>Kami bantu Anda memilih paket terbaik tanpa tekanan.</p>
      </div>
      <div style="flex: 1; min-width: 200px;">
        <h4>Harga Transparan</h4>
        <p>Tanpa biaya tersembunyi. Semua jelas sejak awal.</p>
      </div>
      <div style="flex: 1; min-width: 200px;">
        <h4>Dukungan 24/7</h4>
        <p>Kami siap membantu Anda sebelum, saat, dan setelah perjalanan.</p>
      </div>
      <div style="flex: 1; min-width: 200px;">
        <h4>Dipandu Agen Berpengalaman</h4>
        <p>Didampingi oleh tim yang pernah melayani ribuan jamaah.</p>
      </div>
    </div>
  </div>
</section>

<!-- Section 4: Testimoni -->
<section style="padding: 4rem 1.5rem; background-color: #fff;">
  <div style="max-width: 1000px; margin: auto; text-align: center;">
    <h2 style="font-size: 1.8rem; margin-bottom: 2rem;">Cerita Mereka yang Telah Berangkat</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center;">
      <div style="flex: 1; min-width: 250px;">
        <blockquote style="font-style: italic;">“Sungguh perjalanan Umroh yang berkesan dan tanpa rasa khawatir. Terima kasih tim JalanHaramain!”</blockquote>
        <p><strong>Ahmad, Jakarta</strong></p>
      </div>
      <div style="flex: 1; min-width: 250px;">
        <blockquote style="font-style: italic;">“Paket wisata halalnya lengkap, panduan restorannya juga membantu banget saat ke Turki.”</blockquote>
        <p><strong>Siti, Surabaya</strong></p>
      </div>
    </div>
  </div>
</section>

<!-- Section 5: CTA Subscription -->
<section style="background-color: #f3eee3; padding: 3rem 1.5rem; text-align: center;">
  <h2 style="font-size: 1.7rem; margin-bottom: 1rem;">Siap Memulai Perjalanan Spiritual Anda?</h2>
  <p style="margin-bottom: 1.5rem;">Daftar dan dapatkan informasi terbaru tentang promo, paket baru, dan inspirasi perjalanan halal.</p>
  <form style="max-width: 400px; margin: auto;">
    <input type="email" placeholder="Masukkan email Anda" style="padding: 10px; width: 70%; max-width: 300px;" required />
    <button type="submit" style="padding: 10px 20px; background-color: #000; color: white; border: none;">Berlangganan</button>
  </form>
</section>

@endsection
