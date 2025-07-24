<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calon Agen - Ebook | Admin Dashboard</title>
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
        
        .sidebar ul li {
            margin: 0;
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
        
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 3px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
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
        <h2>Calon Agen - Ebook</h2>
        
        <div class="table-container">
            <h3>Daftar Pendaftar Ebook ({{ $calagenEbooks->count() }} orang)</h3>
            
            @if($calagenEbooks->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Kota</th>
                            <th>WhatsApp</th>
                            <th>Jenis Kelamin</th>
                            <th>Status User</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calagenEbooks as $index => $calagen)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $calagen->nama_lengkap }}</td>
                                <td>{{ $calagen->email }}</td>
                                <td>{{ $calagen->kota_domisili }}</td>
                                <td>{{ $calagen->nomor_whatsapp }}</td>
                                <td>{{ $calagen->jenis_kelamin }}</td>
                                <td>
                                    @if($calagen->is_converted_to_user)
                                        <span class="badge badge-success">Sudah jadi User</span>
                                    @else
                                        <span class="badge badge-warning">Belum jadi User</span>
                                    @endif
                                </td>
                                <td>{{ $calagen->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Belum ada pendaftar ebook.</p>
            @endif
        </div>
    </main>
</body>
</html>