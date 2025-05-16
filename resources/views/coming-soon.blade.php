<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - Jalan Haramain</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .bg-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-overlay min-h-screen">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center px-4 py-12 bg-black bg-opacity-50 backdrop-blur-sm rounded-xl max-w-3xl mx-4">
            <div class="mb-8">
                <h1 class="font-playfair text-5xl md:text-7xl font-bold text-white mb-4 tracking-wider">JALAN HARAMAIN</h1>
                <div class="w-24 h-1 bg-gold-500 mx-auto mb-6" style="background: linear-gradient(to right, #D4AF37, #FFD700)"></div>
                <h2 class="font-poppins text-xl md:text-3xl text-gray-200 mb-8">Umroh & Travel Experience</h2>
            </div>

            <p class="font-poppins text-lg text-gray-300 mb-12 max-w-2xl mx-auto leading-relaxed">
                Embarking on a journey of spiritual enlightenment. Coming soon to guide you on your sacred path.
            </p>

            <!-- Updated button with better visibility -->
            <div class="mb-12">
                <a href="{{ route('webinar') }}" 
                   class="inline-block px-8 py-4 bg-white text-black font-poppins font-bold rounded-lg transform hover:scale-105 transition-all duration-300 hover:shadow-2xl border-2 border-white">
                    Daftar Webinar Gratis
                </a>
            </div>

            <div class="flex justify-center space-x-8 mb-12">
                <a href="https://instagram.com/jalanharamain" target="_blank" 
                   class="group">
                    <div class="p-4 border border-gold-500 rounded-full transition-all duration-300 hover:bg-white hover:border-white">
                        <i class="fab fa-instagram text-2xl text-gold-500 group-hover:text-black" style="color: #D4AF37"></i>
                    </div>
                    <span class="block mt-2 text-sm text-gray-300">Instagram</span>
                </a>
                <a href="https://facebook.com/jalanharamain" target="_blank"
                   class="group">
                    <div class="p-4 border border-gold-500 rounded-full transition-all duration-300 hover:bg-white hover:border-white">
                        <i class="fab fa-facebook text-2xl text-gold-500 group-hover:text-black" style="color: #D4AF37"></i>
                    </div>
                    <span class="block mt-2 text-sm text-gray-300">Facebook</span>
                </a>
            </div>

            <div class="mt-8">
                <p class="font-poppins text-sm text-gray-400">
                    Follow us on social media for exclusive updates and announcements
                </p>
            </div>
        </div>
    </div>
</body>
</html>