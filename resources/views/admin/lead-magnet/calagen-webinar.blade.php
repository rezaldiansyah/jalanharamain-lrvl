<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calon Agen - Webinar | Admin Dashboard</title>
    <style>
        /* Copy styles dari calagen-ebook.blade.php */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 70px;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 70px;
            width: 250px;
            height: calc(100vh - 70px);
            background: white;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
        }
        
        .sidebar ul {
            list-style: none;
            padding: 1rem 0;
        }
        
        .sidebar ul li a {
            display: block;
            padding: 1rem 1.5rem;
            color: #333;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s;
        }
        
        .sidebar ul li a:hover {
            background-color: #f8f9fa;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            margin-top: 70px;
        }
        
        .placeholder-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Admin Dashboard - Jalan HaramAin</h1>
        <div class="user-info">
            <span>Selamat datang, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>
    
    <aside class="sidebar">
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.partners') }}">Travel Rekanan</a></li>
            <li><a href="{{ route('admin.packages') }}">Paket Perjalanan</a></li>
            <li><a href="{{ route('admin.lead-magnet.calagen-ebook') }}">Lead Magnet - Ebook</a></li>
            <li><a href="{{ route('admin.lead-magnet.calagen-webinar') }}">Lead Magnet - Webinar</a></li>
            <li><a href="{{ route('home') }}">Lihat Website</a></li>
        </ul>
    </aside>
    
    <main class="main-content">
        <h2>Calon Agen - Webinar</h2>
        
        <div class="placeholder-container">
            <h3>🚧 Coming Soon</h3>
            <p>Fitur untuk mengelola calon agen dari webinar akan segera hadir.</p>
        </div>
    </main>
</body>
</html>