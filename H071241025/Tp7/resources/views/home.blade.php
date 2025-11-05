@extends('layouts.master')

@section('title', 'Beranda - Eksplor Pariwisata Malang')

@section('content')
<div class="relative h-[600px] overflow-hidden bg-gray-900">
    <div class="carousel-container relative h-full">
        <!-- Slide 1 -->
        <div class="carousel-slide absolute inset-0 transition-opacity duration-200 opacity-100">
            <img src="{{ asset('images/bromo.png') }}" 
                 alt="Gunung Bromo" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>
        
        <!-- Slide 2 -->
        <div class="carousel-slide absolute inset-0 transition-opacity duration-200 opacity-0">
            <img src="{{ asset('images/florawisata-san-terra.png') }}" 
                 alt="Coban Rondo" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>
        
        <!-- Slide 3 -->
        <div class="carousel-slide absolute inset-0 transition-opacity duration-200 opacity-0">
            <img src="{{ asset('images/kampung-warna-warni.jpg') }}" 
                 alt="Kampung Warna-Warni" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>
    </div>
    
    <div class="absolute inset-0 flex items-center justify-center z-10">
        <div class="text-center text-white px-6">
            <h1 class="text-5xl font-bold mb-6 tracking-tight">
                Ayo Eksplor <span class="text-[#DCA278]">Malang!</span>
            </h1>
            <p class="text-xl md:text-2xl font-light mb-8 max-w-3xl mx-auto opacity-90">
                {{ $description }}
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('destinasi') }}" 
                   class="bg-[#CDD4B1] text-gray-900 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition">
                    Jelajahi Sekarang
                </a>
            </div>
        </div>
    </div>
    
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
        <button class="carousel-dot w-3 h-3 rounded-full bg-white opacity-100 transition"></button>
        <button class="carousel-dot w-3 h-3 rounded-full bg-white opacity-50 transition"></button>
        <button class="carousel-dot w-3 h-3 rounded-full bg-white opacity-50 transition"></button>
    </div>
    
    <button class="carousel-prev absolute left-6 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-3 rounded-full z-20 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button class="carousel-next absolute right-6 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-3 rounded-full z-20 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
</div>

<div class="container mx-auto px-6 py-20">
    <div class="max-w-3xl mx-auto text-center mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mt-6 mb-2">Tentang Malang</h2>
        <div class="w-20 h-1 bg-[#DCA278] mx-auto mb-6"></div>
        <p class="text-xl text-gray-600 leading-relaxed">
            Malang merupakan kota terbesar kedua di Jawa Timur yang terkenal dengan udaranya yang sejuk,
            pemandangan alam yang menakjubkan dan dikelilingi oleh pegunungan dan perkebunan.
            Malang menawarkan pengalaman wisata yang lengkap mulai dari alam, sejarah, hingga kuliner.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <div class="text-center p-8">
            <div class="w-16 h-16 bg-[#CDD481] rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">🏔️</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Alam yang Indah</h3>
            <p class="text-gray-600 leading-relaxed">
                Pegunungan, air terjun, dan perkebunan yang memukau mata
            </p>
        </div>

        <div class="text-center p-8">
            <div class="w-16 h-16 bg-[#CDD481] rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">🍜</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Kuliner Khas</h3>
            <p class="text-gray-600 leading-relaxed">
                Cita rasa autentik yang menggugah selera setiap pengunjung
            </p>
        </div>

        <div class="text-center p-8">
            <div class="w-16 h-16 bg-[#CDD481] rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">🌡️</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Udara Sejuk</h3>
            <p class="text-gray-600 leading-relaxed">
                Suhu rata-rata 22-25°C, sempurna untuk liburan keluarga
            </p>
        </div>
    </div>
</div>

<!-- Carousel Script -->
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.opacity = i === index ? '100' : '0';
        });
        dots.forEach((dot, i) => {
            dot.style.opacity = i === index ? '100' : '50';
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }
    
    // auto slide
    setInterval(nextSlide, 5000);

    document.querySelector('.carousel-next').addEventListener('click', nextSlide);
    document.querySelector('.carousel-prev').addEventListener('click', prevSlide);

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });
</script>
@endsection