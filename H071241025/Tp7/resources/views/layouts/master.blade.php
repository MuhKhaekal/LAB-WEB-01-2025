<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', default: 'Eksplor Pariwisata Malang')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background-color: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .nav-link.active::after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-[#FFF9E2] text-gray-800">
    <header class="bg-[#CDD4B1] shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-5">
            <div class="flex justify-between items-center">
                <a href="{{ route('nama') }}" class="text-2xl font-bold text-[#DCA278] tracking-tight">
                    Eksplor Malang
                </a>
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li>
                            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                                Beranda
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('destinasi') }}" :active="request()->routeIs('destinasi')">
                                Destinasi
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('kuliner') }}" :active="request()->routeIs('kuliner')">
                                Kuliner
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('galeri') }}" :active="request()->routeIs('galeri')">
                                Galeri
                            </x-nav-link>
                        </li>
                        <li>
                           <x-nav-link href="{{ route('kontak') }}" :active="request()->routeIs('kontak')">
                                Kontak
                            </x-nav-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-[#CDD4B1] border-t border-gray-200 py-6 mt-20">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Eksplor Malang</h3>
                <p class="text-gray-600 text-sm mb-6">Temukan keindahan tersembunyi di Kota Apel</p>
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Eksplor Malang. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>