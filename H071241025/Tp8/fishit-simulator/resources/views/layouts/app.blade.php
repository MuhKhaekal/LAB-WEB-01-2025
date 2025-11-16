<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fish It Simulator')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .rarity-Common { background-color: #95a5a6; }
        .rarity-Uncommon { background-color: #27ae60; }
        .rarity-Rare { background-color: #3498db; }
        .rarity-Epic { background-color: #9b59b6; }
        .rarity-Legendary { background-color: #f39c12; }
        .rarity-Mythic { background-color: #e74c3c; }
        .rarity-Secret { background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); color: gold; }
    </style>
</head>
<body class="bg-[#EDC55B] min-h-screen">
    <nav class="bg-[#66BCB4] shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <a href="{{ route('fishes.index') }}" class="text-[#EC802B] text-2xl font-bold hover:text-white transition">
                    🎣 Fish It
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <!-- notif sukses -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-700 hover:text-green-900">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- notif error -->
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center py-4 mt-6 text-[#EC802B]">
        <p class="font-bold">"Setiap baris kode yang kamu tulis adalah langkah menuju secret. Teruslah memancing, karena waktu adalah secret."</p>
    </footer>
</body>
</html>