@extends('layouts.master')

@section('title', 'Jelajah Nusantara')  

@section('content')
    <section class="relative h-screen w-full overflow-hidden">
        <img src="{{ asset('images/candi-prambanan.jpg') }}" alt="Candi Prambanan"
            class="animate-slide-down absolute top-0 left-0 w-full h-full object-cover z-0">
        <div class="absolute top-0 left-0 w-full h-full bg-black/40 z-10"></div>
        <div class="relative z-20 flex flex-col justify-start items-center h-full text-beige gap-5 mt-60" data-aos="fade-up"
            data-aos-duration="1000">
            <div class="flex flex-col">
                <h2 class="archivo-black-regular font-extrabold text-4xl text-center">WELCOME TO</h2>
                <h1 class="archivo-black-regular font-extrabold text-8xl">YOGYAKARTA</h1>
            </div>
            <p class="red-hat-display font-semibold text-xl">A City of Endless Wonder and Warmth</p>
        </div>
    </section>

    <section class="m-10">
        <div class="text-mocha flex flex-col gap-5 p-12 px-16">
            <h1 class="playfair-display font-bold text-4xl pb-4" data-aos="fade-up" data-aos-duration="700">
                The Soul of Java, A City of Stories
            </h1>
            <div class="red-hat-display leading-relaxed text-lg">
                <p class="text-justify mb-5" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                    Yogyakarta is not just a destination; it's an experience. It is where the spirit of ancient Javanese
                    kingdoms endures. Imagine grand temples standing in silent majesty, the intricate sounds of gamelan
                    echoing from the palace, and creative energy buzzing in every alley. From the living history within the
                    Keraton walls to the vibrant modern art scenes, every corner holds tradition and innovation
                </p>
                <p class="text-justify" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                    Walk the bustling street of Malioboro at night, explore the magnificent halls of the Sultan's Palace, or
                    discover hidden batik workshops that share stories passed down through generations. This is not just a
                    historic stop; it is a living, breathing center of culture.
                </p>
            </div>
        </div>
    </section>

    <section class="w-full h-full">
        <div class="grid grid-cols-3 gap-0 w-full h-[300px]">
            <x-category-card href="/destinasi" image="candi-prambanan-2.jpg" alt="Candi Prambanan"
                overlayColor="bg-blue-500/50">
                Explore<br>the Scenery
            </x-category-card>

            <x-category-card href="/kuliner" image="gudeg.jpeg" alt="Gudeg Jogja" overlayColor="bg-green-500/50">
                Taste<br>the Culture
            </x-category-card>

            <x-category-card href="/galeri" image="batik.jpg" alt="Jogja Batik" overlayColor="bg-amber-500/50">
                Discover<br>the Heritage
            </x-category-card>
        </div>
    </section>

    <section class="py-16 px-10">
        <div class="container mx-auto">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="playfair-display font-bold text-4xl text-mocha">
                    Yogyakarta by the Numbers
                </h2>
                <p class="red-hat-display text-lg text-mocha mt-2">
                    A brief overview of the Special Region's treasures.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <x-stat-card target="5" title="Special Regions">
                    1 City (Yogyakarta) and 4 Regencies (Sleman, Bantul, Kulon Progo, Gunungkidul).
                </x-stat-card>
                <x-stat-card target="2" title="UNESCO World Heritages">
                    The Cosmological Axis of Yogyakarta and the Prambanan Temple Compounds.
                </x-stat-card>
                <x-stat-card target="8" title="Intangible Heritages">
                    Including Gamelan, Wayang Kulit, Batik, Keris, and other recognized cultural treasures.
                </x-stat-card>
                <x-stat-card target="50" title="Museums & Galleries" suffix="+">
                    Affirming Jogja as a center for education, history, and the arts.
                </x-stat-card>
            </div>
        </div>
    </section>
@endsection
