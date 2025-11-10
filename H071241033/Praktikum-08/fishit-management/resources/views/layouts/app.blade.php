<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allison&family=Anton&family=Archivo+Black&family=Bonheur+Royale&family=Eagle+Lake&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Zalando+Sans+SemiExpanded:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <title>@yield('title', 'Fish It Management')</title>
</head>

<body class="@yield('body-class') mx-16 font-zalando">
    <header class="text-white text-lg flex flex-row justify-between items-center pt-6 pb-4">
        <div>
            <a href="{{ route('home') }}" class="font-semibold text-2xl">FishBase</a>
        </div>
        @if (Route::currentRouteName() == 'home')            
            <x-glass-button href="{{ route('fishes.index') }}" class="text-md">
                Get Started
            </x-glass-button>
        @endif
    </header>

    <div class="container mx-auto ">
        @if (session('success'))
            <div class="mb-4 rounded-xl border border-green-500/50 bg-green-500/10 p-4 shadow-lg backdrop-blur-sm"
                role="alert">
                <span class="font-medium text-green-200">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-xl border border-red-500/50 bg-red-500/10 p-4 shadow-lg backdrop-blur-sm" role="alert">
                <span class="font-medium text-red-200">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1000
        });
    </script>
</body>
</html>