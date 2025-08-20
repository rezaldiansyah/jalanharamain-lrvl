@extends('layouts.admin')

@section('title', 'Manajemen Webinar')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <h2 class="mb-0">Manajemen Webinar</h2>
        </div>
        <a href="{{ route('admin.webinars.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Webinar
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
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Pendaftar</th>
                            <th>URL Publik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($webinars as $index => $webinar)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $webinar->title }}</td>
                                <td>{{ $webinar->date ? $webinar->date->format('d/m/Y') : '-' }}</td>
                                <td>{{ $webinar->time ?? '-' }}</td>
                                <td>
                                    @if($webinar->price > 0)
                                        Rp {{ number_format($webinar->price, 0, ',', '.') }}
                                    @else
                                        <span class="badge bg-success">Gratis</span>
                                    @endif
                                </td>
                                <td>
                                    @if($webinar->status === 'published')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($webinar->status === 'completed')
                                        <span class="badge bg-info">Selesai</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $webinar->registrations_count ?? 0 }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.webinars.edit', $webinar) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.webinars.destroy', $webinar) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('Yakin ingin menghapus webinar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ $webinar->getPublicUrl() }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-external-link-alt"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada webinar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($webinars->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $webinars->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection