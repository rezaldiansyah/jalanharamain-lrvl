<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Jalan HaramAin</title>
    
    <!-- Design System Colors & Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-color: #374da0;
            --secondary-color: #2cbbbc;
            --tertiary-color: #327eac;
            --neutral-light: #f3f4f5;
            --white: #ffffff;
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
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--tertiary-color);
            border-color: var(--tertiary-color);
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <h1>Admin Dashboard - Jalan HaramAin</h1>
        <div class="user-info">
            <span>Selamat datang, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 1rem;">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>
    
    <div class="container-fluid mt-4">
        @yield('content')
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>