@extends('layouts.app')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        
        <!-- Header Section -->
        <div style="text-align: center; color: white; margin-bottom: 3rem;">
            <h1 style="font-size: 3rem; margin-bottom: 1rem; font-weight: bold;">Bergabung Sebagai Agen Travel</h1>
            <p style="font-size: 1.2rem; opacity: 0.9;">Raih penghasilan tambahan dengan menjadi mitra resmi JalanHaramain</p>
        </div>

        <!-- Benefits Section -->
        <div style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 2rem; margin: 2rem 0; backdrop-filter: blur(10px);">
            <h2 style="color: white; text-align: center; margin-bottom: 2rem;">Keuntungan Menjadi Agen</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div style="text-align: center; color: white;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">💰</div>
                    <h3>Komisi Menarik</h3>
                    <p>Dapatkan komisi hingga 2 Juta Rupiah dari setiap penjualan paket</p>
                </div>
                <div style="text-align: center; color: white;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📚</div>
                    <h3>Training Gratis</h3>
                    <p>Pelatihan lengkap tentang industri travel dan penjualan</p>
                </div>
                <div style="text-align: center; color: white;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🎯</div>
                    <h3>Marketing Support</h3>
                    <p>Materi promosi dan dukungan marketing yang lengkap</p>
                </div>
            </div>
        </div>

        <!-- CTA Section untuk EBook Gratis -->
        <div style="background: white; border-radius: 15px; padding: 2rem; margin: 2rem 0; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 style="color: #333; font-size: 2rem; margin-bottom: 1rem;">🎁 Mau EBook Gratis Sekarang?</h2>
                <p style="color: #666; font-size: 1.1rem;">Dapatkan panduan lengkap menjadi agen travel sukses dan akses ke berbagai benefit eksklusif!</p>
            </div>

            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem; border: 1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 1rem; border: 1px solid #f5c6cb;">
                    <ul style="margin: 0; padding-left: 1rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('lead-magnet.register-ebook') }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                @csrf
                
                <div style="grid-column: 1 / -1;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Nama Panggilan *</label>
                    <input type="text" name="nama_panggilan" value="{{ old('nama_panggilan') }}" required 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Kota Domisili *</label>
                    <select name="kota_domisili" required 
                            style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                        <option value="">Pilih Kota</option>
                        @foreach(App\Helpers\Cities::getIndonesianCities() as $key => $city)
                            <option value="{{ $city }}" {{ old('kota_domisili') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Alamat Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Username *</label>
                    <input type="text" name="username" value="{{ old('username') }}" required 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Password *</label>
                    <input type="password" name="password" required 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Nomor WhatsApp *</label>
                    <input type="text" name="nomor_whatsapp" value="{{ old('nomor_whatsapp') }}" placeholder="+62811xxx" required 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #333;">Jenis Kelamin *</label>
                    <select name="jenis_kelamin" required 
                            style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div style="grid-column: 1 / -1; text-align: center; margin-top: 1rem;">
                    <button type="submit" 
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 1rem 3rem; font-size: 1.1rem; font-weight: bold; border-radius: 5px; cursor: pointer; transition: transform 0.2s;">
                        DAFTAR SEKARANG
                    </button>
                </div>
            </form>
        </div>

        

        <!-- eBook Preview -->
        <!--<div style="background: white; border-radius: 15px; padding: 2rem; margin: 2rem 0; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <h2 style="text-align: center; color: #333; margin-bottom: 2rem;">Preview eBook Panduan Agen</h2>
            <div style="text-align: center;">
                <iframe src="https://drive.google.com/file/d/1example/preview" 
                        width="100%" height="400" 
                        style="border: none; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);"></iframe>
            </div>
        </div> -->
    </div>
</div>
@endsection
