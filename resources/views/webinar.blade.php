<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webinar Gratis - Jalan Haramain</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-[#D4AF37] to-[#FFD700] py-12 md:py-20">
            <div class="container mx-auto px-4 max-w-4xl">
                <h1 class="font-playfair text-3xl md:text-5xl lg:text-6xl font-bold text-gray-900 text-center mb-6 leading-tight">
                    {{ $webinar->title ?? 'Bisa Umroh Tiap Bulan dan Penghasilan Juga, Mau?' }}
                </h1>
                <div class="text-gray-800 text-center space-y-4 md:space-y-6 mb-8 md:mb-12">
                    {!! nl2br(e($webinar->description ?? 'Default description...')) !!}
                </div>
               <!-- <div class="text-gray-800 text-center space-y-4 md:space-y-6 mb-8 md:mb-12">
                    <p class="text-lg md:text-xl font-medium">Ingin ke Tanah Suci tapi masih terhalang biaya?</p>
                    <p class="text-base md:text-lg">Bagaimana kalau justru Anda dibayar untuk berangkat ke sana?</p>
                    <p class="text-base md:text-lg">Banyak orang ingin ke Mekkah. Tapi hanya sedikit yang tahu jalannya.</p>
                    <p class="text-base md:text-lg font-semibold">Salah satunya: jadi Tour Leader Umroh.</p>
                </div>

                <div class="text-gray-800 space-y-3 md:space-y-4 mb-8 bg-white/30 p-6 rounded-lg">
                    <p class="font-medium"> Bayu (bukan nama sebenarnya) dulunya staf admin. Hidupnya stagnan, kerja monoton. Sampai ia ikut webinar seperti ini dan melihat peluang.</p>
                    <p class="font-medium">Bayu belajar cara jadi Tour Leader Umroh. Tiga bulan kemudian, ia dampingi satu grup jamaah.</p>
                    <p class="font-medium">Bayu tidak hanya diberangkatkan, tapi juga diberi honor 5 juta per keberangkatan. Kini, ia bisa berangkat lagi sambil menabung untuk orang tuanya.</p>
                    <p class="font-medium">Kalau Bayu bisa, kenapa Anda tidak?</p>
                </div>

                <div class="text-gray-800 space-y-3 md:space-y-4 mb-8 bg-white/30 p-6 rounded-lg">
                    <p class="font-medium">✅ Bisa ibadah</p>
                    <p class="font-medium">✅ Bisa bantu orang</p>
                    <p class="font-medium">✅ Bisa hasilkan 3-5 juta tiap kali berangkat</p>
                    <p class="font-medium">🚀 Ratusan orang sudah memulainya. Anda bisa jadi yang berikutnya.</p>
                </div>

                <div class="bg-white/30 p-6 rounded-lg mb-8 text-gray-800">
                    <p class="mb-4 font-semibold">📚 Dalam webinar ini, Anda akan pelajari:</p>
                    <div class="space-y-3">
                        <p class="font-medium">✅ Cara jadi Tour Leader Umroh meski tanpa pengalaman</p>
                        <p class="font-medium">✅ Potensi penghasilan 3-5 juta per keberangkatan</p>
                        <p class="font-medium">✅ Cara cari jamaah tanpa harus jualan agresif</p>
                        <p class="font-medium">✅ Studi kasus peserta yang sudah berhasil</p>
                    </div>
                </div>

                <div class="bg-white/30 p-6 rounded-lg mb-8 text-gray-800">
                    <p class="font-bold mb-4">🎉 Webinar Gratis - Rezeki dari Jalan Sunnah: Jadi Tour Leader Umroh & Dapatkan Penghasilan 3-5 Juta/Bulan</p>
                    <p class="font-medium">📅 Sabtu, 24 Mei 2025</p>
                    <p class="font-medium">⏰ Pukul 09:00 WIB</p>
                    <p class="font-medium">📍 Online via Zoom Meeting</p>
                    <p class="font-medium">⚡ Kuota peserta terbatas!</p>
                </div>

                <div class="text-gray-800 mb-8">
                    <p class="mb-4 font-bold">🎁 MASIH RAGU ? </p>
                    <div class="space-y-2 bg-white/30 p-6 rounded-lg">
                        <p class="font-medium">Bayangkan... Anda bisa ibadah, bantu sesama, dan pulang bawa rezeki.</p>
                        <p class="font-medium">Tapi jika terus menunda, peluang ini bisa lewat begitu saja. Atau… diambil orang lain yang lebih dulu bergerak.</p>
                        <p class="font-medium">🕌 Jalan ke Tanah Suci bisa terbuka dari sini. Anda tinggal melangkah.</p>
                    </div>
                </div>
                -->

                <div class="text-center">
                    <a href="#daftar" 
                       class="inline-block px-8 py-4 bg-gray-900 text-white font-poppins font-bold rounded-lg hover:bg-gray-800 hover:shadow-2xl transition-all duration-300 text-lg md:text-xl">
                        [DAFTAR SEKARANG - GRATIS]
                    </a>
                </div>
            </div>
        </div>

        <!-- Registration Form -->
        <div id="daftar" class="container mx-auto px-4 py-16">
            <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
                <h2 class="font-playfair text-3xl font-bold text-center mb-8">Form Pendaftaran</h2>
                
                @if ($errors->any())
                    <div class="mb-8 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-8 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('webinar.register') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block font-poppins mb-2">Nama Lengkap *</label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @enderror" 
                               required>
                    </div>

                    <div>
                        <label class="block font-poppins mb-2">Jenis Kelamin *</label>
                        <div class="space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="male" class="form-radio" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                <span class="ml-2">Pria</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="female" class="form-radio" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <span class="ml-2">Wanita</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block font-poppins mb-2">Email *</label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               class="w-full px-4 py-2 border rounded-lg @error('email') border-red-500 @enderror" 
                               required>
                        <p class="text-sm text-gray-500 mt-1">Contoh: nama@domain.com</p>
                    </div>

                    <div>
                        <label class="block font-poppins mb-2">WhatsApp *</label>
                        <input type="tel" 
                               name="whatsapp" 
                               value="{{ old('whatsapp') }}"
                               placeholder="+628123456789"
                               class="w-full px-4 py-2 border rounded-lg @error('whatsapp') border-red-500 @enderror" 
                               required>
                        <p class="text-sm text-gray-500 mt-1">Masukkan nomor dengan format: +62812XXXXX (minimal 10 digit)</p>
                    </div>

                    <div>
                        <label class="block font-poppins mb-2">Kota Domisili *</label>
                        <select name="city" id="citySelect" 
                                class="w-full px-4 py-2 border rounded-lg @error('city') border-red-500 @enderror"
                                required>
                            <option value="">Pilih Kota</option>
                            @foreach($cities as $key => $city)
                                <option value="{{ $key }}" {{ old('city') == $key ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                            <option value="other" {{ old('city') == 'other' ? 'selected' : '' }}>Kota Lainnya</option>
                        </select>
                        
                        <input type="text" 
                               id="otherCity" 
                               name="other_city" 
                               value="{{ old('other_city') }}"
                               class="w-full px-4 py-2 border rounded-lg mt-2 {{ old('city') == 'other' ? '' : 'hidden' }}"
                               placeholder="Masukkan nama kota Anda">
                    </div>

                    <!-- New Source Information Field -->
                    <div>
                        <label class="block font-poppins mb-2">Darimana Anda mengetahui webinar ini? *</label>
                        <select name="source" 
                                class="w-full px-4 py-2 border rounded-lg @error('source') border-red-500 @enderror"
                                required>
                            <option value="">Pilih Sumber Informasi</option>
                            <option value="instagram" {{ old('source') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="facebook" {{ old('source') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="thread" {{ old('source') == 'thread' ? 'selected' : '' }}>Thread</option>
                            <option value="whatsapp" {{ old('source') == 'whatsapp' ? 'selected' : '' }}>WhatsApp Grup</option>
                            <option value="friend" {{ old('source') == 'friend' ? 'selected' : '' }}>Teman/Kerabat</option>
                            <option value="other" {{ old('source') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <!-- Hidden input untuk webinar ID -->
                    <input type="hidden" name="webinar_id" value="{{ $webinar->id ?? '' }}">
                    <!-- Form Submit Button -->
                    <button type="submit" 
                            onclick="handleSubmit(event)"
                            class="w-full py-4 bg-white text-[#D4AF37] font-poppins font-bold rounded-lg hover:shadow-xl transition-all duration-300 border-2 border-[#D4AF37]">
                        Daftar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // City Select Handler
        document.getElementById('citySelect').addEventListener('change', function() {
            const otherCity = document.getElementById('otherCity');
            otherCity.classList.toggle('hidden', this.value !== 'other');
            otherCity.required = this.value === 'other';
        });

        // Form Submission Handler
        function handleSubmit(event) {
            event.preventDefault();
            const form = event.target.closest('form');
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Submit form via AJAX
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to WhatsApp
                    window.location.href = 'https://bit.ly/webinarseriestourleader';
                    
                    // Reset form and show success message
                    setTimeout(() => {
                        form.reset();
                        window.location.href = '#daftar';
                    }, 100);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        }
    </script>
</body>
</html>