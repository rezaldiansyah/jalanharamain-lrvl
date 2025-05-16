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
        <div class="bg-gradient-to-r from-[#D4AF37] to-[#FFD700] py-20">
            <div class="container mx-auto px-4">
                <h1 class="font-playfair text-4xl md:text-6xl font-bold text-white text-center mb-6">
                    Webinar Gratis: Persiapan Umroh yang Baik dan Benar
                </h1>
                <p class="font-poppins text-xl text-white text-center mb-12">
                    Bersama Ustadz dan Travel Expert Berpengalaman
                </p>
                <div class="text-center">
                    <a href="#daftar" class="inline-block px-8 py-4 bg-white text-[#D4AF37] font-poppins font-semibold rounded-lg hover:shadow-2xl transition-all duration-300">
                        Daftar Sekarang
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

                    <button type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-[#D4AF37] to-[#FFD700] text-white font-poppins font-semibold rounded-lg hover:shadow-xl transition-all duration-300">
                        Daftar Webinar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

                    <!-- Add this script before closing body tag -->
                    <script>
                        document.getElementById('citySelect').addEventListener('change', function() {
                            const otherCity = document.getElementById('otherCity');
                            otherCity.classList.toggle('hidden', this.value !== 'other');
                            otherCity.required = this.value === 'other';
                        });
                    </script>