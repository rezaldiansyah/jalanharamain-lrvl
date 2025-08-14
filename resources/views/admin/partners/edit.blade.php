@extends('layouts.admin')

@section('title', 'Edit Travel Rekanan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.partners') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="mb-0">Edit Travel Rekanan</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('admin.partners.update', $partner) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Travel</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Travel <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $partner->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_person" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                           id="contact_person" name="contact_person" value="{{ old('contact_person', $partner->contact_person) }}">
                                    @error('contact_person')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $partner->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $partner->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $partner->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="2">{{ old('address', $partner->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ppiu_number" class="form-label">Nomor PPIU</label>
                                    <input type="text" class="form-control @error('ppiu_number') is-invalid @enderror" 
                                           id="ppiu_number" name="ppiu_number" value="{{ old('ppiu_number', $partner->ppiu_number) }}">
                                    @error('ppiu_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pihk_number" class="form-label">Nomor PIHK</label>
                                    <input type="text" class="form-control @error('pihk_number') is-invalid @enderror" 
                                           id="pihk_number" name="pihk_number" value="{{ old('pihk_number', $partner->pihk_number) }}">
                                    @error('pihk_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Status Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                @if($partner->user)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi User Login</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_name" class="form-label">Nama User</label>
                                    <input type="text" class="form-control @error('user_name') is-invalid @enderror" 
                                           id="user_name" name="user_name" value="{{ old('user_name', $partner->user->name) }}">
                                    @error('user_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_email" class="form-label">Email User</label>
                                    <input type="email" class="form-control @error('user_email') is-invalid @enderror" 
                                           id="user_email" name="user_email" value="{{ old('user_email', $partner->user->email) }}">
                                    @error('user_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('user_password') is-invalid @enderror" 
                                   id="user_password" name="user_password">
                            @error('user_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>
                    </div>
                </div>
                @endif

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.partners') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Travel Rekanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection