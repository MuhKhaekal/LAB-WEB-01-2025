<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- ALL CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Eagle+Lake&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-beige min-h-screen flex flex-col">
    <header id="navbar" class="h-16 absolute top-0 left-0 w-full z-50 " >
        <div id="nav" class="mx-auto flex justify-between items-center py-4 px-10 text-beige">
            <h1 class="eagle-lake-regular text-lg"><span>J</span>elajah</h1>
            <nav class="red-hat-display space-x-4 font-semibold absolute left-1/2 transform -translate-x-1/2
            {{-- [&>a]:transition-all [&>a]:duration-200 [&>a]:ease-in-out --}}
            ">
                <a href="{{ route('home') }}" id="home-nav" 
                    class="{{ request()->routeIs('home') ? 'text-sekunder' : 'hover:text-sekunder' }}">Home</a>
                <a href="{{ route('destinasi') }}" 
                    class="{{ request()->routeIs('destinasi') ? 'text-sekunder' : 'hover:text-sekunder' }}">Destinations</a>
                <a href="{{ route('kuliner') }}" 
                    class="{{ request()->routeIs('kuliner') ? 'text-sekunder' : 'hover:text-sekunder' }}">Culinary</a>
                <a href="{{ route('galeri') }}" 
                    class="{{ request()->routeIs('galeri') ? 'text-sekunder' : 'hover:text-sekunder' }}">Gallery</a>
            </nav>
            <a href="{{ route('kontak') }}" id="cta"
                class="{{ request()->routeIs('kontak') ? 'bg-sekunder text-beige' : "border border-beige hover:bg-sekunder hover:border-sekunder hover:text-beige" }}inline-block red-hat-display px-4 py-1
            {{-- transition-all duration-200 ease-in-out --}}
            ">
                Contact
            </a>
        </div>
    </header>



    <main class="grow">
        @yield('content')
    </main>

    <footer class="bg-white-bone text-mocha flex justify-between text-center py-8 px-7">
        <div>&copy; 2025 Jelajah Nusantara</div>
        <div class="flex flex-row gap-6">
            <a href=""><svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M224.3 141a115 115 0 1 0 -.6 230 115 115 0 1 0 .6-230zm-.6 40.4a74.6 74.6 0 1 1 .6 149.2 74.6 74.6 0 1 1 -.6-149.2zm93.4-45.1a26.8 26.8 0 1 1 53.6 0 26.8 26.8 0 1 1 -53.6 0zm129.7 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM399 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                </svg></a>
            <a href=""><svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5l0-170.3-52.8 0 0-78.2 52.8 0 0-33.7c0-87.1 39.4-127.5 125-127.5 16.2 0 44.2 3.2 55.7 6.4l0 70.8c-6-.6-16.5-1-29.6-1-42 0-58.2 15.9-58.2 57.2l0 27.8 83.6 0-14.4 78.2-69.3 0 0 175.9C413.8 494.8 512 386.9 512 256z" />
                </svg></a>
            <a href=""><svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z" />
                </svg></a>
            <a href=""><svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 576 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M549.7 124.1C543.5 100.4 524.9 81.8 501.4 75.5 458.9 64 288.1 64 288.1 64S117.3 64 74.7 75.5C51.2 81.8 32.7 100.4 26.4 124.1 15 167 15 256.4 15 256.4s0 89.4 11.4 132.3c6.3 23.6 24.8 41.5 48.3 47.8 42.6 11.5 213.4 11.5 213.4 11.5s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zM232.2 337.6l0-162.4 142.7 81.2-142.7 81.2z" />
                </svg></a>
            <a href=""><svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M357.2 48L427.8 48 273.6 224.2 455 464 313 464 201.7 318.6 74.5 464 3.8 464 168.7 275.5-5.2 48 140.4 48 240.9 180.9 357.2 48zM332.4 421.8l39.1 0-252.4-333.8-42 0 255.3 333.8z" />
                </svg></a>
        </div>
    </footer>
    

{{--==========================================================
    =========== LIGHTBOX (MODAL SHOW IMAGE) ==================
    Tinggal tambahkan props 'lightbox' => false,
    class="{{ $lightbox ? 'gallery-image-trigger cursor-pointer' : '' }}", dan 
    @if($lightbox)
        data-image-src="{{ asset('images/' . $image) }}"
    @endif
    ke dalam component atau elemen yang ingin diterapkan modal
    ==========================================================--}}
    <div id="imageModal"
        class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300 ease-out">
        <button id="modalCloseBtn" class="absolute top-4 right-6 text-white text-5xl opacity-70 hover:opacity-100 z-10">
            &times;
        </button>
        <div id="modalBackdropContent" class="p-4">
            <img id="modalImageContent" src="" alt="Galeri Foto" class="block max-w-[90vw] max-h-[90vh] rounded-lg shadow-xl">
        </div>
    </div>


    {{-- MUSIC TOGGLE --}}
    <audio id="bgMusic" autoplay loop muted>
        <source src="{{ asset('audio/Jogja Istimewa.mp3') }}" type="audio/mpeg">
    </audio>
    {{-- <button id="toggleMusic"
        class="fixed bottom-6 z-[9999] right-6 bg-sekunder text-beige px-4 py-2 rounded-md font-semibold shadow-lg transition-all duration-300 hover:scale-105">
        🔇 Music Off
    </button> --}}


    {{-- CDN --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
        });
    </script>
</body>
</html>
