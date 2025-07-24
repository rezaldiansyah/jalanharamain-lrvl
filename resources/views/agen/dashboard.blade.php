<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Agen - Jalan HaramAin</title>
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

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .navbar .user-info span {
            color: #666;
            font-weight: 500;
        }

        .navbar .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .navbar .logout-btn:hover {
            background: #c82333;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .welcome-card h2 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .welcome-card p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .role-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 1rem;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .menu-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .menu-card .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .menu-card h3 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .menu-card p {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .menu-card .btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .menu-card .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .navbar h1 {
                font-size: 1.2rem;
            }

            .container {
                padding: 0 1rem;
            }

            .welcome-card h2 {
                font-size: 1.5rem;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Dashboard Agen - Jalan HaramAin</h1>
        <div class="user-info">
            <span>{{ $user->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h2>Selamat Datang, {{ $user->name }}! 👋</h2>
            <p>Anda telah berhasil login sebagai {{ $user->role }}. Gunakan menu di bawah untuk mengakses fitur-fitur yang tersedia untuk Anda.</p>
            <span class="role-badge">{{ ucfirst($user->role) }}</span>
        </div>

        <div class="menu-grid">
            @if($user->canAccessEbook())
            <div class="menu-card">
                <div class="icon">📚</div>
                <h3>E-book Gratis</h3>
                <p>Akses koleksi e-book gratis tentang panduan umroh, tips perjalanan, dan materi edukasi lainnya.</p>
                <a href="{{ route('agen.ebook-gratis') }}" class="btn">Akses E-book</a>
            </div>
            @endif

            <div class="menu-card">
                <div class="icon">📊</div>
                <h3>Dashboard Statistik</h3>
                <p>Lihat statistik performa Anda sebagai agen dan perkembangan bisnis travel Anda.</p>
                <a href="#" class="btn">Coming Soon</a>
            </div>

            <div class="menu-card">
                <div class="icon">👥</div>
                <h3>Kelola Customer</h3>
                <p>Manajemen data customer, follow-up leads, dan tracking komunikasi dengan calon jamaah.</p>
                <a href="#" class="btn">Coming Soon</a>
            </div>

            <div class="menu-card">
                <div class="icon">📦</div>
                <h3>Paket Umroh</h3>
                <p>Jelajahi dan promosikan berbagai paket umroh yang tersedia untuk customer Anda.</p>
                <a href="#" class="btn">Coming Soon</a>
            </div>
        </div>
    </div>
</body>
</html>