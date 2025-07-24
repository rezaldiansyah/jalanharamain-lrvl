<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-book Gratis - Jalan HaramAin</title>
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

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            color: #333;
            font-size: 1.5rem;
        }

        .navbar .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .navbar .nav-links a {
            color: #666;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .navbar .nav-links a:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .header-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header-card h2 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        .header-card p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .ebook-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .ebook-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .ebook-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .ebook-card .cover {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }

        .ebook-card h3 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .ebook-card p {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .ebook-card .download-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
        }

        .ebook-card .download-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .container {
                padding: 0 1rem;
            }

            .header-card h2 {
                font-size: 2rem;
            }

            .ebook-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>E-book Gratis - Jalan HaramAin</h1>
        <div class="nav-links">
            <a href="{{ route('agen.dashboard') }}">← Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <div class="header-card">
            <h2>📚 Koleksi E-book Gratis</h2>
            <p>Akses koleksi e-book eksklusif untuk agen dan calon agen Jalan HaramAin.</p>
        </div>

        <div class="ebook-grid">
            <div class="ebook-card">
                <div class="cover">🕌</div>
                <h3>Panduan Lengkap Umroh untuk Pemula</h3>
                <p>E-book komprehensif yang membahas semua hal yang perlu diketahui tentang ibadah umroh.</p>
                <a href="#" class="download-btn">Download PDF</a>
            </div>

            <div class="ebook-card">
                <div class="cover">💼</div>
                <h3>Strategi Bisnis Travel Umroh</h3>
                <p>Pelajari strategi dan tips sukses menjalankan bisnis travel umroh.</p>
                <a href="#" class="download-btn">Download PDF</a>
            </div>

            <div class="ebook-card">
                <div class="cover">🎯</div>
                <h3>Digital Marketing untuk Agen Travel</h3>
                <p>Panduan praktis menggunakan digital marketing untuk mempromosikan paket umroh.</p>
                <a href="#" class="download-btn">Download PDF</a>
            </div>
        </div>
    </div>
</body>
</html>