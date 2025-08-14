@extends('layouts.admin')

@section('title', 'Manajemen Paket Perjalanan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <h2 class="mb-0">Paket Perjalanan</h2>
        </div>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Paket Perjalanan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($packages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Kategori</th>
                                <th>Travel Partner</th>
                                <th>Destinasi</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($packages as $package)
                                <tr>
                                    <td>{{ $loop->iteration + ($packages->currentPage() - 1) * $packages->perPage() }}</td>
                                    <td>{{ $package->name }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $package->category_label }}</span>
                                    </td>
                                    <td>{{ $package->travelPartner->name }}</td>
                                    <td>{{ $package->destination }}</td>
                                    <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($package->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                    data-bs-toggle="modal" data-bs-target="#viewModal{{ $package->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('admin.packages.edit', $package) }}" 
                                               class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.packages.duplicate', $package) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menduplikat paket ini?')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-info" 
                                                        title="Duplikat Paket">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.packages.destroy', $package) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada paket perjalanan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $packages->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-suitcase-rolling fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada paket perjalanan</h5>
                    <p class="text-muted">Mulai tambahkan paket perjalanan pertama Anda</p>
                    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Paket Perjalanan
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- View Modals -->
@foreach($packages as $package)
<div class="modal fade" id="viewModal{{ $package->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Paket: {{ $package->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Dasar</h6>
                        <table class="table table-sm">
                            <tr><td><strong>Travel Partner:</strong></td><td>{{ $package->travelPartner->name }}</td></tr>
                            <tr><td><strong>Destinasi:</strong></td><td>{{ $package->destination }}</td></tr>
                            <tr><td><strong>Durasi:</strong></td><td>{{ $package->duration_days }} hari</td></tr>
                            <tr><td><strong>Harga:</strong></td><td>Rp {{ number_format($package->price, 0, ',', '.') }}</td></tr>
                            <tr><td><strong>Max Peserta:</strong></td><td>{{ $package->max_participants }} orang</td></tr>
                            <tr><td><strong>Periode:</strong></td><td>{{ $package->start_date->format('d/m/Y') }} - {{ $package->end_date->format('d/m/Y') }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Deskripsi</h6>
                        <p>{{ $package->description }}</p>
                    </div>
                </div>
                
                @if($package->itinerary)
                <div class="mt-3">
                    <h6>Itinerary</h6>
                    <div class="border p-3 rounded bg-light">
                        {!! nl2br(e($package->itinerary)) !!}
                    </div>
                </div>
                @endif
                
                <div class="row mt-3">
                    @if($package->includes)
                    <div class="col-md-6">
                        <h6>Termasuk</h6>
                        <div class="border p-3 rounded bg-success bg-opacity-10">
                            {!! nl2br(e($package->includes)) !!}
                        </div>
                    </div>
                    @endif
                    
                    @if($package->excludes)
                    <div class="col-md-6">
                        <h6>Tidak Termasuk</h6>
                        <div class="border p-3 rounded bg-danger bg-opacity-10">
                            {!! nl2br(e($package->excludes)) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection