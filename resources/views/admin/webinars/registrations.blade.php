@extends('layouts.admin')

@section('title', 'Pendaftar Webinar')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.webinars.index') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="mb-0">Pendaftar: {{ $webinar->title }}</h2>
        </div>
        <div>
            <a href="{{ route('admin.webinars.registrations.export', $webinar) }}" class="btn btn-success">
                <i class="fas fa-file-csv"></i> Ekspor CSV
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($registrations->count() === 0)
                <p class="text-muted mb-0">Belum ada pendaftar.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>WhatsApp</th>
                                <th>Kota</th>
                                <th>Sumber</th>
                                <th>Terdaftar Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $index => $r)
                                <tr>
                                    <td>{{ $registrations->firstItem() + $index }}</td>
                                    <td>{{ $r->name }}</td>
                                    <td>{{ $r->gender }}</td>
                                    <td>{{ $r->email }}</td>
                                    <td>{{ $r->whatsapp }}</td>
                                    <td>{{ $r->city }}</td>
                                    <td>{{ $r->source }}</td>
                                    <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $registrations->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection