@props([
    'href',
    'image',
    'alt',
    'overlayColor'
])

<a href="{{ $href }}" class="relative group overflow-hidden" data-aos="fade-zoom-in"
    data-aos-easing="ease-in-out" data-aos-duration="1000">
    <img src="{{ asset('images/' . $image) }}" alt="{{ $alt }}"
        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    <div
        class="absolute inset-0 {{ $overlayColor }} opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex justify-center items-center text-center">
        <h2 class="text-white playfair-display text-5xl font-bold text-left">
            {!! $slot !!} 
        </h2>
    </div>
</a>