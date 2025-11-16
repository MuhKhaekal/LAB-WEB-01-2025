@extends('layouts.master')

@section('title', 'Kuliner')

@section('content')
    <section class="relative h-screen w-full overflow-hidden">
        <img src="{{ asset('images/gudeg-bg.jpg') }}" alt="Gudeg Jogja"
            class="absolute top-0 left-0 w-full h-full object-cover z-0 brightness-75">
        <div class="absolute top-0 left-0 w-full h-full bg-black/40 z-10"></div>

        <div class="relative z-20 flex flex-col justify-center items-center h-full text-beige" data-aos="fade-up"
            data-aos-duration="1000">
            <h1 class="archivo-black-regular font-extrabold text-7xl">A TASTE OF TRADITION</h1>
            <p class="red-hat-display font-semibold text-xl mt-2">Exploring the legendary flavors of Yogyakarta.</p>
        </div>
    </section>

    <section class="py-20 px-10">
        <div class="pb-3 px-16 flex flex-col justify-center items-center"
        data-aos="fade-down" data-aos-duration="1000">
            <h1 class="playfair-display font-bold text-mocha text-4xl">The Must-Try Legends</h1>
            <p class="red-hat-display text-md text-mocha mt-2 text-center">You haven’t truly been to Jogja until you’ve tasted these three culinary pillars.<br>They embody the authentic flavors that define the city.</p>
        </div>
        <div class="container mx-auto flex flex-col gap-24 p-12 px-16">

            <x-feature-showcase
                image="gudeg-jogja.png"
                alt="Gudeg Jogja"
                category="The Icon"
                title="Gudeg"
                layout="image-left"
            >
                <p class="red-hat-display text-md text-mocha leading-relaxed text-justify">
                    No visit is complete without trying Gudeg, the legendary sweet jackfruit stew. Slowly simmered
                    for hours with coconut milk and palm sugar, it's typically served with rice, krecek (spicy
                    cattle skin stew), chicken, and a hard-boiled egg. It's the definitive taste of Jogja.
                </p>
            </x-feature-showcase>

            <x-feature-showcase
                image="sate-klatak.jpeg"
                alt="Sate Klatak"
                category="The Evening Ritual"
                title="Sate Klatak"
                layout="image-right"
            >
                <p class="red-hat-display text-md text-mocha leading-relaxed text-justify">
                    A unique culinary experience, Sate Klatak is mutton satay seasoned only with salt and grilled
                    on bicycle spokes. The metal spokes conduct heat better, cooking the meat perfectly from the
                    inside out. It's a must-try dish, typically enjoyed at night with savory curry soup.
                </p>
            </x-feature-showcase>

            <x-feature-showcase
                image="bakmi-jawa.jpg"
                alt="Bakmi Jawa"
                category="The Smoky Aroma"
                title="Bakmi Jawa"
                layout="image-left"
            >
                <p class="red-hat-display text-md text-mocha leading-relaxed text-justify">
                    Authentic Javanese noodles are defined by their unique smoky aroma, achieved by cooking over
                    a traditional charcoal stove (anglo). Whether you choose fried (goreng) or boiled (godog),
                    this comforting dish, often with duck egg, is a staple of Jogja's culinary scene.
                </p>
            </x-feature-showcase>

        </div>
    </section>
    
@endsection