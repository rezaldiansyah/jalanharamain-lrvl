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
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Detail Paket</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="itinerary" class="form-label">Itinerary</label>
                            <textarea class="form-control @error('itinerary') is-invalid @enderror" 
                                      id="itinerary" name="itinerary" rows="6" 
                                      placeholder="Contoh:\nHari 1: Keberangkatan dari Jakarta\nHari 2: Tiba di Makkah, Check-in hotel\n...">{{ old('itinerary', $package->itinerary) }}</textarea>
                            @error('itinerary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="includes" class="form-label">Yang Termasuk</label>
                                    <textarea class="form-control @error('includes') is-invalid @enderror" 
                                              id="includes" name="includes" rows="4" 
                                              placeholder="Contoh:\n- Tiket pesawat PP\n- Hotel bintang 4\n- Makan 3x sehari\n...">{{ old('includes', $package->includes) }}</textarea>
                                    @error('includes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="excludes" class="form-label">Yang Tidak Termasuk</label>
                                    <textarea class="form-control @error('excludes') is-invalid @enderror" 
                                              id="excludes" name="excludes" rows="4" 
                                              placeholder="Contoh:\n- Visa\n- Asuransi perjalanan\n- Pengeluaran pribadi\n...">{{ old('excludes', $package->excludes) }}</textarea>
                                    @error('excludes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Paket Aktif (dapat dilihat publik)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-2 mb-4">
                    <a href="{{ route('travel.packages') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Paket
                    </button>
                </div>
            </form>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Informasi Travel Partner</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td><strong>Nama Travel:</strong></td><td>{{ $travelPartner->name }}</td></tr>
                        <tr><td><strong>Contact Person:</strong></td><td>{{ $travelPartner->contact_person }}</td></tr>
                        <tr><td><strong>Email:</strong></td><td>{{ $travelPartner->email }}</td></tr>
                        <tr><td><strong>PPIU:</strong></td><td>{{ $travelPartner->ppiu_number ?: '-' }}</td></tr>
                        <tr><td><strong>PIHK:</strong></td><td>{{ $travelPartner->pihk_number ?: '-' }}</td></tr>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Tips Pengisian</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-lightbulb text-warning me-2"></i>
                            <small>Gunakan nama paket yang menarik dan mudah diingat</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-lightbulb text-warning me-2"></i>
                            <small>Isi deskripsi dengan detail untuk menarik minat jamaah</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-lightbulb text-warning me-2"></i>
                            <small>Pastikan harga kompetitif dan sesuai fasilitas</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-lightbulb text-warning me-2"></i>
                            <small>Upload gambar yang menarik untuk paket travel</small>
                        </li>
                        <li>
                            <i class="fas fa-lightbulb text-warning me-2"></i>
                            <small>Centang "Paket Aktif" agar dapat dilihat calon jamaah</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
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