<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Detail Paket – {{ $package->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        :root { --primary:#4b5bdc; --bg:#f7f8fb; --text:#1f2937; --muted:#6b7280; --border:#e5e7eb; --soft:#f3f4f6; }
        body { margin:0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; background:var(--bg); color:var(--text); }
        .container { max-width: 1150px; margin: 0 auto; padding: 24px; }
        /* Breadcrumb bergaya pill agar konsisten dengan beranda */
        .breadcrumb { display:flex; align-items:center; gap:8px; font-size:0.92rem; color:var(--muted); margin-bottom: 14px; }
        .crumb { display:flex; align-items:center; gap:6px; background:#fff; border:1px solid var(--border); border-radius:999px; padding:6px 12px; color:#4b5563; text-decoration:none; font-weight:700; }
        .crumb:hover { border-color:#d1d5db; }
        .crumb-icon { font-size:16px; }
        .crumb-sep { color:#c1c5d0; }
        .breadcrumb a { color:var(--primary); text-decoration: none; }
        .header { background: #fff; border:1px solid var(--border); border-radius: 16px; overflow: hidden; }
        .image-wrap { position: relative; background: linear-gradient(180deg, #eef2ff, #ffffff); }
        .image-pad { width: 100%; height: 0; padding-top: 45%; }
        .image { position: absolute; top:0; left:0; width:100%; height:100%; object-fit: cover; }
        .image-empty { display:flex; align-items:center; justify-content:center; color:var(--muted); background:var(--soft); font-weight:600; }
        .image-overlay { position:absolute; inset:0; background: linear-gradient(180deg, rgba(0,0,0,0.0), rgba(0,0,0,0.12)); }
        .badge-row { position:absolute; left:18px; bottom:18px; display:flex; gap:8px; z-index:2; }
        .badge { background:#fff; border:1px solid var(--border); color:var(--text); padding:6px 10px; border-radius:999px; font-size:0.85rem; font-weight:700; box-shadow:0 4px 10px rgba(0,0,0,0.06); }
        .header-content { padding: 20px 20px 24px; }
        .title { margin:0 0 6px; font-size: 1.8rem; font-weight: 800; color:#111827; }
        .sub { margin:0; font-size: 0.98rem; color:var(--muted); }

        .grid { display: grid; grid-template-columns: 1fr; gap: 18px; margin-top: 18px; }
        @media (min-width: 900px) { .grid { grid-template-columns: 2fr 1fr; } }
        .card { background:#fff; border:1px solid var(--border); border-radius: 14px; padding: 16px; }
        .card h3 { margin:0 0 12px; font-size:1.15rem; font-weight:800; color:#111827; }

        .meta-grid { display:grid; grid-template-columns: 1fr 1fr; gap:12px; }
        .meta-item { background:#f9fafb; border:1px solid var(--border); border-radius: 12px; padding: 12px; display:flex; align-items:center; gap:10px; }
        .meta-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; background:#eef2ff; color:#111827; font-size:18px; }
        .meta-text { display:flex; flex-direction:column; }
        .meta-text .label { font-size: 0.78rem; color:var(--muted); }
        .meta-text .value { font-size: 1rem; font-weight: 700; color:#111827; }

        .price { font-size:1.6rem; font-weight:900; color:#059669; }
        .muted { color:var(--muted); }

        .btn { display:inline-block; padding:12px 14px; border-radius: 12px; text-decoration:none; font-weight:800; text-align:center; transition:transform .05s ease, box-shadow .2s ease; }
        .btn:active { transform: scale(0.995); }
        .btn-primary { background:var(--primary); color:#fff; box-shadow:0 6px 14px rgba(75,91,220,0.25); }
        .btn-primary:hover { filter:brightness(1.05); }
        .btn-secondary { background:#eef2ff; color:#111827; border:1px solid var(--border); }
        .btn-tertiary { background:#fff; color:#111827; border:1px dashed var(--border); }

        .sticky { position: sticky; top: 24px; }
        .stack { display:flex; flex-direction:column; gap:10px; }

        @media (max-width: 899px) {
            .meta-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="breadcrumb">
        <a href="{{ url('/') }}" class="crumb"><span class="crumb-icon">🏠</span> Beranda</a>
        <span class="crumb-sep">›</span>
        <a href="{{ url('/?category=' . ($package->category ?? '')) }}" class="crumb"><span class="crumb-icon">🧳</span> Paket {{ $package->category_label ?? 'Perjalanan' }}</a>
        <span class="crumb-sep">›</span>
        <span class="crumb"><span class="crumb-icon">📄</span> Detail</span>
    </div>

    <div class="header">
        <div class="image-wrap">
            <div class="image-pad"></div>
            @php
                $img = $package->image && file_exists(public_path($package->image)) ? asset($package->image) : null;
            @endphp
            @if($img)
                <img src="{{ $img }}" alt="{{ $package->name }}" class="image" />
            @else
                <div class="image image-empty">Tidak ada gambar</div>
            @endif
            <div class="image-overlay"></div>
            <div class="badge-row">
                <span class="badge">{{ $package->category_label ?? ucfirst($package->category ?? 'Paket') }}</span>
                <span class="badge">{{ $package->duration_days }} Hari</span>
                <span class="badge">{{ \Carbon\Carbon::parse($package->start_date)->format('d M Y') }}</span>
            </div>
        </div>
        <div class="header-content">
            <h1 class="title">{{ $package->name }}</h1>
            <p class="sub">{{ $package->destination }} · Kategori: {{ $package->category_label ?? ucfirst($package->category ?? 'lainnya') }}</p>
        </div>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Ringkasan</h3>
            <div class="meta-grid">
                <div class="meta-item">
                    <div class="meta-icon">💰</div>
                    <div class="meta-text">
                        <div class="label">Harga</div>
                        <div class="value price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">🕒</div>
                    <div class="meta-text">
                        <div class="label">Durasi</div>
                        <div class="value">{{ $package->duration_days }} Hari</div>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">📅</div>
                    <div class="meta-text">
                        <div class="label">Keberangkatan</div>
                        <div class="value">{{ \Carbon\Carbon::parse($package->start_date)->format('d M Y') }}</div>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">📆</div>
                    <div class="meta-text">
                        <div class="label">Kepulangan</div>
                        <div class="value">{{ \Carbon\Carbon::parse($package->end_date)->format('d M Y') }}</div>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">📍</div>
                    <div class="meta-text">
                        <div class="label">Tujuan</div>
                        <div class="value">{{ $package->destination }}</div>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">👥</div>
                    <div class="meta-text">
                        <div class="label">Kapasitas</div>
                        <div class="value">{{ $package->max_participants }} peserta</div>
                    </div>
                </div>
            </div>

            @if(!empty($package->agent_fee))
                <div style="margin-top:12px; background:#fff; border:1px dashed var(--border); border-radius:12px; padding:12px;">
                    <div class="muted">Biaya Agen</div>
                    <div class="value" style="font-weight:800;">
                        @if($package->agent_fee_type === 'percentage')
                            {{ $package->agent_fee }}%
                        @else
                            Rp {{ number_format($package->agent_fee, 0, ',', '.') }}
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="card sticky">
            <h3>Ringkasan Harga</h3>
            <div class="price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
            <div class="muted" style="margin-top:6px;">Termasuk layanan inti sesuai deskripsi paket.</div>

            @php
                $partner = $package->travelPartner;
                $rawPhone = $partner?->phone;
                $waPhone = $rawPhone ? preg_replace('/\D+/', '', $rawPhone) : null; // angka saja
                if ($waPhone) {
                    if (\Illuminate\Support\Str::startsWith($waPhone, '+')) {
                        $waPhone = ltrim($waPhone, '+');
                    }
                    if (\Illuminate\Support\Str::startsWith($waPhone, '0')) {
                        $waPhone = '62' . substr($waPhone, 1); // konversi 08xx -> 62xx
                    }
                }
                $message = "Assalamualaikum, saya tertarik dengan paket: " . ($package->name ?? '') .
                           " (" . \Carbon\Carbon::parse($package->start_date)->format('d M Y') .
                           " - " . \Carbon\Carbon::parse($package->end_date)->format('d M Y') . "). Mohon info pendaftaran dan detail lebih lanjut. Terima kasih.";
                $waLink = $waPhone ? ('https://wa.me/' . $waPhone . '?text=' . urlencode($message)) : null;
            @endphp

            <div class="stack" style="margin-top:12px;">
                @if($waLink)
                    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-primary">Daftar / Tanya Admin</a>
                @else
                    <a href="#" class="btn btn-primary" onclick="alert('Nomor WhatsApp agen belum tersedia.'); return false;">Daftar / Tanya Admin</a>
                @endif
                <a href="{{ route('home', ['category' => $package->category ?? null]) }}" class="btn btn-secondary">Lihat Paket Lain</a>
                <a href="#" class="btn btn-tertiary">Bagikan</a>
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