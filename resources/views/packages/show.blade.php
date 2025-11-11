<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Detail Paket – {{ $package->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body { margin:0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; background:#f7f8fb; color:#1f2937; }
        .container { max-width: 1100px; margin: 0 auto; padding: 24px; }
        .breadcrumb { font-size: 0.9rem; color:#6b7280; margin-bottom: 14px; }
        .breadcrumb a { color:#4b5bdc; text-decoration: none; }
        .header { background: #fff; border:1px solid #e5e7eb; border-radius: 14px; overflow: hidden; }
        .image-wrap { position: relative; background:#eef2ff; }
        .image-pad { width: 100%; height: 0; padding-top: 56.25%; }
        .image { position: absolute; top:0; left:0; width:100%; height:100%; object-fit: cover; }
        .header-content { padding: 18px 18px 22px; }
        .title { margin:0 0 4px; font-size: 1.6rem; font-weight: 800; color:#111827; }
        .sub { margin:0; font-size: 0.95rem; color:#4b5563; }
        .grid { display: grid; grid-template-columns: 1fr; gap: 18px; margin-top: 18px; }
        @media (min-width: 900px) { .grid { grid-template-columns: 2fr 1fr; } }
        .card { background:#fff; border:1px solid #e5e7eb; border-radius: 12px; padding: 16px; }
        .card h3 { margin:0 0 10px; font-size:1.1rem; font-weight:700; color:#111827; }
        .meta { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .meta-item { background:#f9fafb; border:1px solid #e5e7eb; border-radius: 10px; padding: 10px 12px; }
        .meta-item .label { font-size: 0.78rem; color:#6b7280; }
        .meta-item .value { font-size: 1rem; font-weight: 700; color:#111827; }
        .price { font-size:1.4rem; font-weight:800; color:#059669; }
        .list { margin: 0; padding-left: 18px; }
        .muted { color:#6b7280; }
        .btn-row { display:flex; gap:10px; margin-top: 10px; }
        .btn { display:inline-block; padding:10px 14px; border-radius: 10px; text-decoration:none; font-weight:700; }
        .btn-primary { background:#4b5bdc; color:#fff; }
        .btn-secondary { background:#eef2ff; color:#1f2937; }
        .partner { display:flex; align-items:flex-start; gap:12px; }
        .partner .name { font-weight:800; }
    </style>
</head>
<body>
<div class="container">
    <div class="breadcrumb">
        <a href="{{ url('/') }}">Beranda</a> · <a href="{{ url('/?category=' . ($package->category ?? '')) }}">Paket {{ $package->category_label ?? 'Perjalanan' }}</a> · Detail
    </div>

    <div class="header">
        <div class="image-wrap">
            <div class="image-pad"></div>
            @php
                $img = $package->image && file_exists(public_path($package->image)) ? asset($package->image) : null;
            @endphp
            @if($img)
                <img class="image" src="{{ $img }}" alt="{{ $package->name }}">
            @else
                <div class="image" style="display:flex;align-items:center;justify-content:center;color:#6b7280;background:#f3f4f6;">Tidak ada gambar</div>
            @endif
        </div>
        <div class="header-content">
            <h1 class="title">{{ $package->name }}</h1>
            <p class="sub">{{ $package->destination }} · Kategori: {{ $package->category_label ?? ucfirst($package->category ?? 'lainnya') }}</p>
        </div>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Ringkasan</h3>
            <div class="meta">
                <div class="meta-item">
                    <div class="label">Harga</div>
                    <div class="value price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                </div>
                <div class="meta-item">
                    <div class="label">Durasi</div>
                    <div class="value">{{ $package->duration_days }} Hari</div>
                </div>
                <div class="meta-item">
                    <div class="label">Keberangkatan</div>
                    <div class="value">{{ \Carbon\Carbon::parse($package->start_date)->format('d M Y') }}</div>
                </div>
                <div class="meta-item">
                    <div class="label">Kepulangan</div>
                    <div class="value">{{ \Carbon\Carbon::parse($package->end_date)->format('d M Y') }}</div>
                </div>
                <div class="meta-item">
                    <div class="label">Kapasitas</div>
                    <div class="value">{{ $package->max_participants }} Orang</div>
                </div>
                <div class="meta-item">
                    <div class="label">Status</div>
                    <div class="value">{{ $package->is_active ? 'Aktif' : 'Tidak Aktif' }}</div>
                </div>
            </div>

            <div class="btn-row">
                <a href="{{ url('/?category=' . ($package->category ?? '')) }}#packages" class="btn btn-secondary">Kembali ke Paket</a>
                <a href="#" class="btn btn-primary">Daftar / Tanya Admin</a>
            </div>
        </div>

        <div class="card">
            <h3>Penyelenggara</h3>
            <div class="partner">
                <div>
                    <div class="name">{{ $package->travelPartner->name ?? 'N/A' }}</div>
                    <div class="muted">{{ $package->travelPartner->contact_person ?? '' }} · {{ $package->travelPartner->phone ?? '' }}</div>
                    <div class="muted">PPIU: {{ $package->travelPartner->ppiu_number ?? '-' }} · PIHK: {{ $package->travelPartner->pihk_number ?? '-' }}</div>
                    @if(!empty($package->agent_fee))
                        <div class="muted">Fee Agen: 
                            @if($package->agent_fee_type === 'percentage')
                                {{ $package->agent_fee }}%
                            @else
                                Rp {{ number_format($package->agent_fee, 0, ',', '.') }}
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Deskripsi</h3>
            <p>{!! nl2br(e($package->description)) !!}</p>
        </div>
        <div class="card">
            <h3>Itinerary (Ringkas)</h3>
            @if($package->itinerary)
                <p>{!! nl2br(e($package->itinerary)) !!}</p>
            @else
                <p class="muted">Belum ada data itinerary.</p>
            @endif
        </div>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Termasuk</h3>
            @if($package->includes)
                <p>{!! nl2br(e($package->includes)) !!}</p>
            @else
                <p class="muted">Tidak ada data.</p>
            @endif
        </div>
        <div class="card">
            <h3>Tidak Termasuk</h3>
            @if($package->excludes)
                <p>{!! nl2br(e($package->excludes)) !!}</p>
            @else
                <p class="muted">Tidak ada data.</p>
            @endif
        </div>
    </div>
</div>
</body>
</html>