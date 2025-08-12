<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Book Gratis - Dashboard Agen Jalan Haramain</title>
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
            text-align: center;
        }

        .ebooks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .ebook-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .ebook-card:hover {
            transform: translateY(-5px);
        }

        .ebook-content {
            padding: 20px;
        }

        .ebook-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .ebook-description {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .ebook-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 14px;
            color: #888;
        }

        .badge {
            background: #4CAF50;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .btn {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
            width: 100%;
        }

        .btn:hover {
            background: #45a049;
        }

        .btn-secondary {
            background: #6c757d;
            margin-bottom: 10px;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 E-Book Gratis</h1>
            <p>Koleksi e-book gratis untuk {{ auth()->user()->isAgen() ? 'agen' : 'calon agen' }}</p>
            <a href="{{ route('agen.dashboard') }}" class="btn btn-secondary" style="margin-top: 15px; width: auto;">← Kembali ke Dashboard</a>
        </div>

        @if($ebooks->count() > 0)
            <div class="ebooks-grid">
                @foreach($ebooks as $ebook)
                    <div class="ebook-card">
                        <div class="ebook-content">
                            <h3 class="ebook-title">{{ $ebook->title }}</h3>
                            
                            @if($ebook->description)
                                <p class="ebook-description">{{ $ebook->description }}</p>
                            @endif
                            
                            <div class="ebook-meta">
                                <span class="badge">{{ ucfirst($ebook->category) }}</span>
                                <span>{{ $ebook->created_at->format('d/m/Y') }}</span>
                            </div>
                            
                            <a href="{{ route('agen.ebook.view', $ebook) }}" class="btn" target="_blank">
                                📖 Baca E-Book
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="ebook-card">
                <div class="empty-state">
                    <h3>📚 Belum Ada E-Book</h3>
                    <p>Saat ini belum ada e-book gratis yang tersedia.</p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>