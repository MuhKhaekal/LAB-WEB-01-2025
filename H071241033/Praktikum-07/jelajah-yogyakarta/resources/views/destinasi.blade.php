@extends('layouts.master')

@section('title', 'Destinasi')

@section('content')
    <section class="relative h-screen w-full overflow-hidden">
        <img src="{{ asset('images/tugu-jogja-2.jpg') }}" alt="Tugu Jogja"
            class="absolute top-0 left-0 w-full h-full object-cover z-0 brightness-75">
        <div class="absolute top-0 left-0 w-full h-full bg-black/40 z-10"></div>

        <div class="relative z-20 flex flex-col justify-center items-center h-full text-beige" data-aos="fade-up"
            data-aos-duration="1000">
            <h1 class="archivo-black-regular font-extrabold text-7xl">ICONIC DESTINATIONS</h1>
            <p class="red-hat-display font-semibold text-xl mt-2">The places that define Yogyakarta.</p>
        </div>
    </section>

    <section class="py-20 px-10">
        <div class="container mx-auto flex flex-col gap-24 p-12 px-16">

            <x-feature-showcase image="candi-prambanan-3.webp" alt="Candi Prambanan" category="History & Heritage"
                title="Candi Prambanan" layout="image-left" href="https://prambanan.injourneydestination.id/destination-info/">
                <p class="red-hat-display text-md text-mocha leading-relaxed text-justify">
                    As the largest Hindu temple complex in Indonesia, Prambanan is a marvel of ancient architecture and
                    a UNESCO World Heritage site. Its towering, intricately carved spires are dedicated to the Trimurti
                    (Brahma, Vishnu, Shiva). Visiting at sunset provides an unforgettable silhouette against the sky.
                </p>
                {{-- <a href="" class="red-hat-display text-md absolutebottom-0 text-mocha hover:text-sekunder">More
                    about Candi Prambanan</a> --}}
            </x-feature-showcase>

            <x-feature-showcase image="keraton-yogyakarta.jpg" alt="Keraton Yogyakarta" category="The Cultural Heart"
                title="Keraton Yogyakarta" layout="image-right" href="https://kebudayaan.jogjakota.go.id/page/index/kawasan-kraton">
                <p class="red-hat-display text-md text-mocha leading-relaxed text-justify">
                    The Sultan's Palace, or Keraton, is more than just a royal residence; it's the living soul of
                    Jogja's culture. This vast complex is a fine example of Javanese palace architecture, complete with
                    museums, performance pavilions, and royal guards (Abdi Dalem) in traditional attire.
                </p>
            </x-feature-showcase>

            <x-feature-showcase image="heha-sky-view-2.webp" alt="HeHa Sky View" category="Modern & Scenery"
                title="HeHa Sky View" layout="image-left" href="https://visitingjogja.jogjaprov.go.id/28956/heha-sky-view/">
                <p class="red-hat-display text-md text-mocha leading-relaxed text-justify">
                    Representing the modern face of Jogja's tourism, HeHa Sky View offers a stunning 180-degree
                    panoramic view of the city from the hills of Gunungkidul. It's the perfect spot for photos, enjoying
                    the sunset, and dining with a spectacular backdrop.
                </p>
            </x-feature-showcase>

        </div>
    </section>

    <section class="relative h-screen pt-20 px-10  overflow-hidden z-30">
        <img src="{{ asset('images/bg-nature.png') }}" alt="Jogja Nature"
            class="absolute inset-0 w-full h-full object-cover filter brightness-50 z-0">
        <div class="absolute inset-0 backdrop-blur-sm z-10"></div>
        <div class="absolute inset-0 bg-green-900/40 mix-blend-overlay z-10"></div>

        <div class="relative z-20 container mx-auto text-center">
            <div class="mb-10" data-aos="fade-up">
                <h2 class="playfair-display font-bold text-4xl text-beige">Nature's Wonders</h2>
                <p class="red-hat-display text-lg text-beige mt-2">
                    From volcanic peaks to ocean cliffs, explore the raw, untamed beauty of Yogyakarta.
                </p>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-16">
                <!-- Card 1 -->
                <x-thematic-card title="Goa Jomblang" image="goa-jomblang.png" delay="100">
                    Descend into a hidden forest and witness the heavenly 'Ray of Light' in this vertical cave.
                </x-thematic-card>

                <!-- Card 2 -->
                <x-thematic-card title="Pantai Timang" image="pantai-timang.jpg" delay="200">
                    Challenge your adrenaline on a manual wooden gondola, crossing the rough sea to a rocky
                    island.
                </x-thematic-card>

                <!-- Card 3 -->
                <x-thematic-card title="Merapi Lava Tour" image="merapi-lava-tour.jpg" delay="300">
                    Explore the dramatic volcanic landscape on an off-road jeep, a testament to nature's power.
                </x-thematic-card>
            </div>
        </div>
    </section>


    <section class="relative h-screen pt-20 px-10 overflow-hidden z-20">
        <img src="{{ asset('images/keraton-yogyakarta.jpg') }}" alt="Jogja Culture"
            class="absolute inset-0 w-full h-full object-cover filter brightness-50 z-0">
        <div class="absolute inset-0 backdrop-blur-sm z-10"></div>
        <div class="absolute inset-0 bg-gray-900/40 mix-blend-overlay z-10"></div>

        <div class="relative z-20 container mx-auto flex flex-col items-center text-center">
            <div class="mb-10" data-aos="fade-up">
                <h2 class="playfair-display font-bold text-4xl text-beige"> The Cultural Heartbeat
                </h2>
                <p class="red-hat-display text-lg text-beige mt-2"> Connect with centuries of tradition, art, and stories
                    that define the true soul of Java.
                </p>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-16">
                <!-- Card 1 -->
                <x-thematic-card title="Ramayana Ballet" image="ramayana-ballet.webp" delay="100">
                    Watch the epic Hindu saga come to life in a spectacular dance performance, with Prambanan as
                    its backdrop.
                </x-thematic-card>

                <!-- Card 2 -->
                <x-thematic-card title="Ullen Sentalu Museum" image="ullen-sentalu.jpg" delay="200">
                    A beautifully curated museum dedicated to Javanese culture and the art of the royal
                    families.
                </x-thematic-card>

                <!-- Card 3 -->
                <x-thematic-card title="Kasongan Village" image="kasongan-village.jpg" delay="300">
                    Visit the center of clay artistry and pottery, where you can see artisans at work or even
                    try it yourself.
                </x-thematic-card>
            </div>
        </div>
    </section>

    <section class="relative h-screen pt-20 px-10 overflow-hidden z-10">
        <img src="{{ asset('images/malioboro-siang.jpg') }}" alt="Malioboro Jogja"
            class="absolute inset-0 w-full h-full object-cover filter brightness-50 z-0">
        <div class="absolute inset-0 backdrop-blur-sm z-10"></div>
        <div class="absolute inset-0 bg-blue-900/40 mix-blend-overlay z-10"></div>
    
        <div class="relative z-20 container mx-auto text-center">
            <div class="mb-10" data-aos="fade-up">
                <h2 class="playfair-display font-bold text-4xl text-beige"> Feel the City's Pulse
                </h2>
                <p class="red-hat-display text-lg text-beige mt-2"> Discover the vibrant, eclectic, and creative energy of
                    Jogja's urban heart.
                </p>
            </div>
            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-16">
                <!-- Card 1 -->
                <x-thematic-card title="Alun-Alun Kidul" image="alun-alun-kidul.jpg" delay="100">
                    Experience the unique night-time atmosphere, try the twin banyan tree myth, and ride
                    neon-lit pedal cars.
                </x-thematic-card>

                <!-- Card 2 -->
                <x-thematic-card title="Pasar Beringharjo" image="pasar-beringharjo.jpg" delay="200">
                    The oldest and largest traditional market in Jogja, a sensory overload of batik, spices, and
                    local life.
                </x-thematic-card>

                <!-- Card 3 -->
                <x-thematic-card title="Angkringan & Kopi Joss" image="angkringan.jpg" delay="300">
                    End your day like a local at a simple roadside stall, sipping coffee with a piece of burning
                    charcoal.
                </x-thematic-card>
            </div>
        </div>
    </section>
@endsection
