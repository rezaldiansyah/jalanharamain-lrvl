<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Travel Dashboard') - Jalan HaramAin</title>
    
    <!-- Design System Colors & Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-color: #374da0;
            --secondary-color: #2cbbbc;
            --tertiary-color: #327eac;
            --neutral-light: #f3f4f5;
            --white: #ffffff;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: var(--neutral-light);
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--tertiary-color) 100%);
            color: var(--white);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .sidebar {
            background-color: var(--white);
            min-height: calc(100vh - 80px);
            padding: 1.5rem 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            border-radius: 0;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: var(--white);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--tertiary-color);
            border-color: var(--tertiary-color);
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary:hover {
            background-color: #239a9b;
            border-color: #239a9b;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .stats-card {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--tertiary-color) 100%);
            color: var(--white);
        }
    </style>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <h1><i class="fas fa-plane me-2"></i>Travel Dashboard - Jalan HaramAin</h1>
        <div class="user-info">
            <span>Selamat datang, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 1rem;">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                </button>
            </form>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar">
                    <nav class="nav flex-column">
                        <a class="nav-link {{ request()->routeIs('travel.dashboard') ? 'active' : '' }}" href="{{ route('travel.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('travel.profile*') ? 'active' : '' }}" href="{{ route('travel.profile') }}">
                            <i class="fas fa-building me-2"></i>Profil Travel
                        </a>
                        <a class="nav-link {{ request()->routeIs('travel.packages*') ? 'active' : '' }}" href="{{ route('travel.packages') }}">
                            <i class="fas fa-suitcase me-2"></i>Paket Travel
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="p-4">
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>