@extends('layouts.travel')

@section('title', 'Dashboard Travel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-tachometer-alt me-2"></i>Dashboard Travel Partner</h2>
</div>

@if($travelPartner)
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <i class="fas fa-suitcase fa-2x mb-2"></i>
                    <h3>{{ $totalPackages }}</h3>
                    <p class="mb-0">Total Paket</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <h3>{{ $activePackages }}</h3>
                    <p class="mb-0">Paket Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <i class="fas fa-building fa-2x mb-2"></i>
                    <h3>{{ $travelPartner->is_active ? 'Aktif' : 'Nonaktif' }}</h3>
                    <p class="mb-0">Status Travel</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Travel Partner Info -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-building me-2"></i>Informasi Travel Partner</h5>
                    <a href="{{ route('travel.profile.edit') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit Profil
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama Travel:</strong> {{ $travelPartner->name }}</p>
                            <p><strong>Contact Person:</strong> {{ $travelPartner->contact_person }}</p>
                            <p><strong>Email:</strong> {{ $travelPartner->email }}</p>
                            <p><strong>Telepon:</strong> {{ $travelPartner->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            @if($travelPartner->ppiu_number)
                                <p><strong>Nomor PPIU:</strong> {{ $travelPartner->ppiu_number }}</p>
                            @endif
                            @if($travelPartner->pihk_number)
                                <p><strong>Nomor PIHK:</strong> {{ $travelPartner->pihk_number }}</p>
                            @endif
                            <p><strong>Status:</strong> 
                                <span class="badge {{ $travelPartner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $travelPartner->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    @if($travelPartner->description)
                        <hr>
                        <p><strong>Deskripsi:</strong></p>
                        <p>{{ $travelPartner->description }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('travel.packages.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Tambah Paket Baru
                        </a>
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Kelola Paket</h5>
                                    <p class="card-text">Tambah dan kelola paket travel Anda</p>
                                    <a href="{{ route('travel.packages') }}" class="btn btn-primary">Kelola Paket</a>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('travel.profile') }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-1"></i>Lihat Profil Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Packages -->
    @if($recentPackages->count() > 0)
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Paket Terbaru</h5>
                <a href="{{ route('travel.packages') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-right me-1"></i>Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Destinasi</th>
                                <th>Durasi</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPackages as $package)
                                <tr>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ $package->destination }}</td>
                                    <td>{{ $package->duration_days }} hari</td>
                                    <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $package->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>{{ $package->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-suitcase fa-3x text-muted mb-3"></i>
                <h5>Belum Ada Paket Travel</h5>
                <p class="text-muted">Mulai dengan membuat paket travel pertama Anda.</p>
                <a href="{{ route('travel.packages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Buat Paket Pertama
                </a>
            </div>
        </div>
    @endif
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-building fa-3x text-muted mb-3"></i>
            <h5>Profil Travel Partner Belum Lengkap</h5>
            <p class="text-muted">Silakan lengkapi profil travel partner Anda terlebih dahulu untuk dapat menggunakan dashboard ini.</p>
            <a href="{{ route('travel.profile.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Lengkapi Profil
            </a>
        </div>
    </div>
@endif
@endsection