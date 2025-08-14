@extends('layouts.admin')

@section('title', 'Travel Rekanan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <h2 class="mb-0">Travel Rekanan</h2>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Travel Rekanan
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Travel</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>PPIU</th>
                            <th>PIHK</th>
                            <th>User Travel</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $index => $partner)
                            <tr>
                                <td>{{ $partners->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $partner->name }}</strong>
                                    @if($partner->description)
                                        <br><small class="text-muted">{{ Str::limit($partner->description, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    {{ $partner->contact_person }}
                                    @if($partner->phone)
                                        <br><small class="text-muted">{{ $partner->phone }}</small>
                                    @endif
                                </td>
                                <td>{{ $partner->email }}</td>
                                <td>
                                    @if($partner->ppiu_number)
                                        <span class="badge bg-info">{{ $partner->ppiu_number }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($partner->pihk_number)
                                        <span class="badge bg-success">{{ $partner->pihk_number }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($partner->user)
                                        <span class="badge bg-primary">{{ $partner->user->name }}</span>
                                        <br><small class="text-muted">{{ $partner->user->email }}</small>
                                    @else
                                        <span class="text-muted">Belum ada user</span>
                                    @endif
                                </td>
                                <td>
                                    @if($partner->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.partners.show', $partner) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus travel partner ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Belum ada data travel rekanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $partners->links() }}
        </div>
    </div>
</div>
@endsection