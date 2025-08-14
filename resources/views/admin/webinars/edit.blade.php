@extends('layouts.admin')

@section('title', 'Edit Webinar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Webinar: {{ $webinar->title }}</h3>
                </div>
                <form action="{{ route('admin.webinars.update', $webinar) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Webinar <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $webinar->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                                           id="subtitle" name="subtitle" value="{{ old('subtitle', $webinar->subtitle ?? '') }}">
                                    @error('subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $webinar->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                           id="date" name="date" value="{{ old('date', $webinar->date?->format('Y-m-d')) }}">
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="time" class="form-label">Waktu</label>
                                    <input type="time" class="form-control @error('time') is-invalid @enderror" 
                                           id="time" name="time" value="{{ old('time', $webinar->time?->format('H:i')) }}">
                                    @error('time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', $webinar->price ?? 0) }}" min="0">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Kosongkan atau isi 0 untuk webinar gratis</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="speaker" class="form-label">Pembicara</label>
                                    <input type="text" class="form-control @error('speaker') is-invalid @enderror" 
                                           id="speaker" name="speaker" value="{{ old('speaker', $webinar->speaker ?? '') }}">
                                    @error('speaker')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_participants" class="form-label">Maksimal Peserta</label>
                                    <input type="number" class="form-control @error('max_participants') is-invalid @enderror" 
                                           id="max_participants" name="max_participants" value="{{ old('max_participants', $webinar->max_participants) }}" min="1">
                                    @error('max_participants')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Kosongkan untuk tidak membatasi peserta</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="platform" class="form-label">Platform <span class="text-danger">*</span></label>
                                    <select class="form-control @error('platform') is-invalid @enderror" 
                                            id="platform" name="platform" required>
                                        <option value="">Pilih Platform</option>
                                        <option value="zoom" {{ old('platform', $webinar->platform) == 'zoom' ? 'selected' : '' }}>Zoom</option>
                                        <option value="google-meet" {{ old('platform', $webinar->platform) == 'google-meet' ? 'selected' : '' }}>Google Meet</option>
                                        <option value="teams" {{ old('platform', $webinar->platform) == 'teams' ? 'selected' : '' }}>Microsoft Teams</option>
                                        <option value="webex" {{ old('platform', $webinar->platform) == 'webex' ? 'selected' : '' }}>Webex</option>
                                        <option value="lainnya" {{ old('platform', $webinar->platform) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('platform')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="template" class="form-label">Template <span class="text-danger">*</span></label>
                                    <select class="form-control @error('template') is-invalid @enderror" 
                                            id="template" name="template" required>
                                        <option value="">Pilih Template</option>
                                        <option value="webinar" {{ old('template', $webinar->template) == 'webinar' ? 'selected' : '' }}>Template Webinar</option>
                                        <option value="webinardua" {{ old('template', $webinar->template) == 'webinardua' ? 'selected' : '' }}>Template Webinar Dua</option>
                                    </select>
                                    @error('template')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="meeting_link" class="form-label">Link Meeting</label>
                            <input type="url" class="form-control @error('meeting_link') is-invalid @enderror" 
                                   id="meeting_link" name="meeting_link" value="{{ old('meeting_link', $webinar->meeting_link) }}" 
                                   placeholder="https://zoom.us/j/123456789">
                            @error('meeting_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Link untuk bergabung ke webinar</small>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Banner</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, PNG, maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                               value="1" {{ old('is_active', $webinar->status === 'published') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Aktif (Published)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($webinar->slug)
                        <div class="alert alert-info">
                            <strong>URL Publik:</strong> 
                            <a href="{{ $webinar->getPublicUrl() }}" target="_blank">{{ $webinar->getPublicUrl() }}</a>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.webinars.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="button" class="btn btn-danger float-end" onclick="confirmDelete()">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Form untuk hapus webinar -->
<form id="deleteForm" action="{{ route('admin.webinars.destroy', $webinar) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus webinar ini? Tindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection