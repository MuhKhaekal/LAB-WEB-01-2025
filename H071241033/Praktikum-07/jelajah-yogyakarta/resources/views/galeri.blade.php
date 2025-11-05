@extends('layouts.master')

@section('title', 'Galeri')

@section('content')
    <section id="hero-section" class="relative pt-24 pb-16 px-10 h-screen w-full overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/malioboro-night.jpg') }}" alt="bg-malioboro-night"
                class="w-full h-full object-cover brightness-50">
        </div>
        <div class="absolute inset-0 backdrop-blur-sm z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-transparent to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>

        <div class="h-2/5 relative z-20 w-full mt-7 text-center text-beige" data-aos="fade-up">
            <h1 class="archivo-black-regular font-extrabold text-5xl">CAPTURED YOGYAKARTA</h1>
            <p class="red-hat-display font-semibold text-xl mt-2">A curated collection of sights from the Soul of Java.</p>
        </div>

        <div class="relative z-20 grid grid-cols-1 md:grid-cols-5 gap-2 w-full max-w-7xl mx-auto px-10">
            <x-photo-card image="candi-prambanan-2.jpg" title="Candi Prambanan" delay="100" />

            <x-photo-card image="batik.jpg" title="Batik" delay="200" />

            <x-photo-card image="malioboro-siang.jpg" title="Malioboro" delay="300" />

            <x-photo-card image="ullen-sentalu.jpg" title="Ullen Sentalu" delay="400" />

            <div class="relative h-60 rounded-xl overflow-hidden flex items-center justify-center text-beige font-semibold  group"
                data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                <div
                    class="absolute inset-0 grid grid-cols-2 grid-rows-2 filter grayscale group-hover:grayscale-0 transition-all duration-600">
                    <img src="{{ asset('images/bg-nature.png') }}" class="w-full h-full object-cover" />
                    <img src="{{ asset('images/kasongan-village.jpg') }}" class="w-full h-full object-cover" />
                    <img src="{{ asset('images/ramayana-ballet.webp') }}" class="w-full h-full object-cover" />
                    <img src="{{ asset('images/tugu-jogja.jpg') }}" class="w-full h-full object-cover" />
                </div>
                <div
                    class="absolute inset-0 backdrop-blur-sm bg-black/40 transition-all duration-300 group-hover:bg-black/30">
                </div>

                <!--====== CTA BUTTON VER.1 ======-->
                {{-- <a href="" id="galery-cta"
                    class="relative h-full w-full flex items-center justify-center z-10 red-hat-display hover:scale-110 transition-transform duration-500">
                    <div class="flex flex-col text-left max-w-fit">
                        <span class="text-2xl font-bold">Explore</span>
                        <span class="text-lg font-medium">the full gallery</span>
                    </div>
                </a> --}}

                <!--====== CTA BUTTON VER.2 ======-->
                <div class="relative z-10 flex items-center justify-center">
                    <button id="galery-cta" class="button" style="--clr: #000000">
                        <span class="button__icon-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="button__icon-svg" width="14">
                                <path d="M12 4V20M12 20L18 14M12 20L6 14" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg viewBox="0 0 24 24" fill="none" width="14" xmlns="http://www.w3.org/2000/svg"
                                class="button__icon-svg button__icon-svg--copy">
                                <path d="M12 4V20M12 20L18 14M12 20L6 14" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        Explore All
                    </button>
                </div>
                <!--==============================-->

            </div>
        </div>
    </section>

    <section id="galery-container" class="hidden">
        <section id="galery-section-1" class="py-20 px-10 bg-beige relative">
            <div class="container mx-auto max-w-7xl">

                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="playfair-display font-bold text-4xl text-mocha">
                        Are you captivated by Architecture & Heritage?
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div class="md:col-span-2" data-aos="fade-up" data-aos-delay="100">
                        <x-photo-card image="prambanan-relief.jpg" title="Prambanan Relief" delay="0" lightbox />
                    </div>

                    <div data-aos="fade-up" data-aos-delay="200">
                        <x-photo-card image="keraton-yogyakarta.jpg" title="Keraton Gate" delay="0" lightbox />
                    </div>

                    <div data-aos="fade-up" data-aos-delay="300">
                        <x-photo-card image="taman-sari.jpg" title="Taman Sari" delay="0" lightbox />
                    </div>

                    <div data-aos="fade-up" data-aos-delay="400">
                        <x-photo-card image="plengkung-gading.jpg" title="Plengkung Gading" delay="0" lightbox />
                    </div>

                    <div data-aos="fade-up" data-aos-delay="500">
                        <x-photo-card image="vredeburg-fort.jpg" title="Vredeburg Fort" delay="0" lightbox />
                    </div>

                    <div class="md:col-span-2" data-aos="fade-up" data-aos-delay="600">
                        <x-photo-card image="borobudur-stupa.jpg" title="Borobudur Stupa" delay="0" lightbox />
                    </div>

                </div>
            </div>
        </section>

        <section class="py-5 px-10 bg-beige relative z-20">
            <div class="container mx-auto max-w-7xl">

                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="playfair-display font-bold text-4xl text-mocha">
                        Or do you prefer Nature's grand design?
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">

                    <div class="md:col-span-2" data-aos="fade-up" data-aos-delay="100">
                        <x-photo-card image="goa-jomblang.png" title="Goa Jomblang" delay="0" lightbox />
                    </div>

                    <div class="md:col-span-2" data-aos="fade-up" data-aos-delay="200">
                        <x-photo-card image="pantai-timang.jpg" title="Pantai Timang" delay="0" lightbox />
                    </div>

                    <div class="md:col-span-2" data-aos="fade-up" data-aos-delay="300">
                        <x-photo-card image="pantai-indrayanti.webp" title="Pantai Indrayanti" delay="0" lightbox />
                    </div>

                    <div class="md:col-span-3" data-aos="fade-up" data-aos-delay="400">
                        <x-photo-card image="merapi-lava-tour.jpg" title="Merapi Lava Tour" delay="0" lightbox />
                    </div>

                    <div class="md:col-span-3" data-aos="fade-up" data-aos-delay="500">
                        <x-photo-card image="heha-sky-view-2.webp" title="HeHa Sky View" delay="0" lightbox />
                    </div>

                </div>
            </div>
        </section>

        <section class="py-20 px-10 bg-beige relative z-10 -mt-1">
            <div class="container mx-auto max-w-7xl">

                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="playfair-display font-bold text-4xl text-mocha">
                        Why not explore every moment?
                    </h2>
                </div>

                <div class="columns-2 md:columns-4 gap-4">
                    @foreach ($galleryImages as $item)
                        <x-masonry-card 
                            :image="$item['image']" 
                            :title="$item['title']" 
                            :delay="$item['delay']" 
                            lightbox 
                        />
                    @endforeach
                </div>
            </div>
        </section>


    </section>
@endsection
