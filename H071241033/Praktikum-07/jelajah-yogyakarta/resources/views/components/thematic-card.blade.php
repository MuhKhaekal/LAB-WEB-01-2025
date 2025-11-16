@props([
    'title',
    'image',
    'delay' => '100'
])

<div data-aos="fade" data-aos-delay="{{ $delay }}" data-aos-duration="1000">
    <div
        class="group relative bg-white/10 h-80 backdrop-blur-md rounded-xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover-shadow-gold">
        <img src="{{ asset('images/' . $image) }}" alt="{{ $title }}"
            class="w-full h-3/5 object-cover">
        <div class="flex flex-col justify-start text-left px-6 py-4">
            <h3 class="playfair-display font-bold text-xl text-sekunder mb-3">{{ $title }}</h3>
            <p class="red-hat-display text-xs text-beige">
                {{ $slot }}
            </p>
        </div>
    </div>
</div>