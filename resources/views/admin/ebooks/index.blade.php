<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen E-Book - Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .btn:hover {
            background: #45a049;
        }

        .btn-danger {
            background: #f44336;
        }

        .btn-danger:hover {
            background: #da190b;
        }

        .btn-warning {
            background: #ff9800;
        }

        .btn-warning:hover {
            background: #e68900;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>📚 Manajemen E-Book</h1>
                <p>Kelola e-book gratis dan berbayar</p>
            </div>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">← Kembali ke Dashboard</a>
                <a href="{{ route('admin.ebooks.create') }}" class="btn">+ Upload E-Book Baru</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ebooks as $ebook)
                        <tr>
                            <td>
                                <strong>{{ $ebook->title }}</strong>
                                @if($ebook->description)
                                    <br><small style="color: #666;">{{ Str::limit($ebook->description, 50) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $ebook->category === 'gratis' ? 'badge-success' : 'badge-warning' }}">
                                    {{ ucfirst($ebook->category) }}
                                </span>
                            </td>
                            <td>
                                @if($ebook->category === 'berbayar')
                                    Rp {{ number_format($ebook->price, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <small>{{ $ebook->file_name }}</small><br>
                                <small style="color: #666;">{{ number_format($ebook->file_size / 1024, 0) }} KB</small>
                            </td>
                            <td>
                                <span class="badge {{ $ebook->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $ebook->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>{{ $ebook->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.ebooks.edit', $ebook) }}" class="btn btn-warning" style="margin-right: 5px;">Edit</a>
                                <form action="{{ route('admin.ebooks.destroy', $ebook) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus e-book ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px; color: #666;">
                                Belum ada e-book yang diupload
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($ebooks->hasPages())
            <div style="margin-top: 20px; text-align: center;">
                {{ $ebooks->links() }}
            </div>
        @endif
    </div>
</body>
</html>