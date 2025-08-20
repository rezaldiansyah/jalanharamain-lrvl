@extends('layouts.travel')

@section('title', 'Edit Paket Travel')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('travel.packages') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="mb-0">Edit Paket Travel</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('travel.packages.update', $package) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Dasar</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Paket <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $package->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="destination" class="form-label">Destinasi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('destination') is-invalid @enderror" 
                                           id="destination" name="destination" value="{{ old('destination', $package->destination) }}" required>
                                    @error('destination')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori Paket <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="umroh" {{ old('category', $package->category) == 'umroh' ? 'selected' : '' }}>Umroh</option>
                                <option value="haji_khusus" {{ old('category', $package->category) == 'haji_khusus' ? 'selected' : '' }}>Haji Khusus</option>
                                <option value="wisata_halal" {{ old('category', $package->category) == 'wisata_halal' ? 'selected' : '' }}>Wisata Halal</option>
                                <option value="lainnya" {{ old('category', $package->category) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description', $package->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Paket</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($package->image)
                                <div class="mt-2">
                                    <small class="text-muted">Gambar saat ini:</small><br>
                                    <img src="{{ asset($package->image) }}" alt="Package Image" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Harga & Kapasitas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="duration_days" class="form-label">Durasi (Hari) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('duration_days') is-invalid @enderror" 
                                           id="duration_days" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" min="1" required>
                                    @error('duration_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', $package->price) }}" min="0" step="0.01" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="max_participants" class="form-label">Maksimal Peserta <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('max_participants') is-invalid @enderror" 
                                           id="max_participants" name="max_participants" value="{{ old('max_participants', $package->max_participants) }}" min="1" required>
                                    @error('max_participants')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Komisi Agen -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Komisi Agen</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="agent_fee" class="form-label">Fee Agen</label>
                    <input type="number" class="form-control @error('agent_fee') is-invalid @enderror" 
                           id="agent_fee" name="agent_fee" value="{{ old('agent_fee', $package->agent_fee) }}" 
                           min="0" step="0.01" placeholder="Masukkan fee agen">
                    @error('agent_fee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                        </div>
                     </div>
                 <div class="col-md-6">
                    <div class="mb-3">
                    <label for="agent_fee_type" class="form-label">Tipe Fee</label>
                    <select class="form-select @error('agent_fee_type') is-invalid @enderror" 
                            id="agent_fee_type" name="agent_fee_type">
                        <option value="fixed" {{ old('agent_fee_type', $package->agent_fee_type) == 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
                        <option value="percentage" {{ old('agent_fee_type', $package->agent_fee_type) == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                    </select>
                    @error('agent_fee_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                        </div>
                     </div>
                    </div>
                 </div>
                    <div class="form-text">
                    <strong>Nominal Tetap:</strong> Fee dalam rupiah (contoh: 500000 = Rp 500.000)<br>
                    <strong>Persentase:</strong> Fee dalam persen dari harga paket (contoh: 5 = 5%)
                    </div>
                    </div>
                </div>


                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Jadwal</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                           id="start_date" name="start_date" value="{{ old('start_date', $package->start_date->format('Y-m-d')) }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                           id="end_date" name="end_date" value="{{ old('end_date', $package->end_date->format('Y-m-d')) }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Detail Paket -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Detail Paket</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="itinerary" class="form-label">Itinerary <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('itinerary') is-invalid @enderror" 
                                      id="itinerary" name="itinerary" rows="8" required 
                                      placeholder="Masukkan detail itinerary perjalanan...">{{ old('itinerary', $package->itinerary) }}</textarea>
                            @error('itinerary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="included" class="form-label">Yang Termasuk</label>
                            <textarea class="form-control @error('included') is-invalid @enderror" 
                                      id="included" name="included" rows="5" 
                                      placeholder="Contoh: Tiket pesawat, Hotel, Makan, dll...">{{ old('included', $package->included) }}</textarea>
                            @error('included')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="excluded" class="form-label">Yang Tidak Termasuk</label>
                            <textarea class="form-control @error('excluded') is-invalid @enderror" 
                                      id="excluded" name="excluded" rows="5" 
                                      placeholder="Contoh: Visa, Asuransi perjalanan, dll...">{{ old('excluded', $package->excluded) }}</textarea>
                            @error('excluded')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Status -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Paket Aktif
                            </label>
                        </div>
                        <div class="form-text">Centang untuk mengaktifkan paket ini agar dapat dilihat oleh publik</div>
                    </div>
                </div>
                
                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('travel.packages') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Paket</button>
                </div>
                
                </form>
                
                <div class="mt-4 p-3 bg-light rounded">
                    <h6>Informasi Travel Partner</h6>
                    <p class="mb-1"><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p class="mb-0"><strong>Status:</strong> 
                        @if(auth()->user()->travelPartner && auth()->user()->travelPartner->is_verified)
                            <span class="badge bg-success">Terverifikasi</span>
                        @else
                            <span class="badge bg-warning">Belum Terverifikasi</span>
                        @endif
                    </p>
                </div>
                
                <div class="mt-3 alert alert-info">
                    <h6>Tips Pengisian:</h6>
                    <ul class="mb-0">
                        <li>Pastikan semua informasi yang diisi akurat dan lengkap</li>
                        <li>Gunakan deskripsi yang menarik untuk menarik minat calon peserta</li>
                        <li>Upload gambar dengan kualitas baik (maksimal 2MB)</li>
                        <li>Tentukan harga yang kompetitif sesuai dengan fasilitas yang ditawarkan</li>
                    </ul>
                </div>
                
                <script>
                // Auto calculate end date based on start date and duration
                document.getElementById('start_date').addEventListener('change', calculateEndDate);
                document.getElementById('duration_days').addEventListener('change', calculateEndDate);
                
                function calculateEndDate() {
                    const startDate = document.getElementById('start_date').value;
                    const duration = document.getElementById('duration_days').value;
                    
                    if (startDate && duration) {
                        const start = new Date(startDate);
                        const end = new Date(start);
                        end.setDate(start.getDate() + parseInt(duration) - 1);
                        
                        const endDateString = end.toISOString().split('T')[0];
                        document.getElementById('end_date').value = endDateString;
                    }
                }
                
                // Image preview
                document.getElementById('image').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Create or update preview image
                            let preview = document.getElementById('image-preview');
                            if (!preview) {
                                preview = document.createElement('img');
                                preview.id = 'image-preview';
                                preview.className = 'img-thumbnail mt-2';
                                preview.style.maxWidth = '200px';
                                e.target.parentNode.appendChild(preview);
                            }
                            preview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
                </script>
                @endsection