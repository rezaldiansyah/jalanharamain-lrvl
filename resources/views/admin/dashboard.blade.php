<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Jalan Haram Ain</title>
    <style>
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
        }
        
        .navbar h1 {
            font-size: 1.5rem;
        }
        
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 70px;
            width: 250px;
            height: calc(100vh - 70px);
            background: white;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }
        
        .sidebar ul {
            list-style: none;
        }
        
        .sidebar ul li {
            padding: 0.75rem 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .sidebar ul li a {
            color: #333;
            text-decoration: none;
            display: block;
        }
        
        .sidebar ul li:hover {
            background-color: #f8f9fa;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            margin-top: 70px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-card h3 {
            color: #667eea;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-card p {
            color: #666;
            font-size: 1rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 0.25rem;
        }
        
        .btn:hover {
            background: #5a6fd8;
        }
        
        .logout-btn {
            background: #e74c3c;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .sidebar ul li.has-submenu {
            position: relative;
        }
        
        .sidebar ul li.has-submenu > a::after {
            content: '▼';
            float: right;
            transition: transform 0.3s;
        }
        
        .sidebar ul li.has-submenu.open > a::after {
            transform: rotate(180deg);
        }
        
        .submenu {
            display: none;
            background-color: #f1f3f4;
            padding-left: 1rem;
        }
        
        .submenu.show {
            display: block;
        }
        
        .submenu li a {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
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
            <li class="has-submenu">
                <a href="#" onclick="toggleSubmenu(this)">Lead Magnet</a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.lead-magnet.calagen-ebook') }}">Calon Agen - Ebook</a></li>
                    <li><a href="{{ route('admin.lead-magnet.calagen-webinar') }}">Calon Agen - Webinar</a></li>
                </ul>
            </li>
            <li><a href="{{ route('home') }}">Lihat Website</a></li>
        </ul>
    </aside>
    
    <main class="main-content">
        <h2>Dashboard Overview</h2>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>{{ $partnersCount }}</h3>
                <p>Total Travel Rekanan</p>
            </div>
            
            <div class="stat-card">
                <h3>{{ $packagesCount }}</h3>
                <p>Total Paket Perjalanan</p>
            </div>
            
            <div class="stat-card">
                <h3>{{ $activePackages }}</h3>
                <p>Paket Aktif</p>
            </div>
        </div>
        
        <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3>Quick Actions</h3>
            <div style="margin-top: 1rem;">
                <a href="{{ route('admin.partners.create') }}" class="btn">Tambah Travel Rekanan</a>
                <a href="{{ route('admin.packages.create') }}" class="btn">Tambah Paket Perjalanan</a>
            </div>
        </div>
    </main>
</body>
</html>

<script>
    function toggleSubmenu(element) {
        const submenu = element.nextElementSibling;
        const parentLi = element.parentElement;
        
        submenu.classList.toggle('show');
        parentLi.classList.toggle('open');
    }
</script>