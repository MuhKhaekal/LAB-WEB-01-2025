@props([
    'image',
    'title',
    'delay' => '100',
    'lightbox' => false
])

<div class="mb-4 break-inside-avoid {{ $lightbox ? 'gallery-image-trigger cursor-pointer' : '' }}"
    @if($lightbox)
        data-image-src="{{ asset('images/' . $image) }}"
    @endif
    data-aos="fade-up"
    data-aos-delay="{{ $delay }}">
    <div class="relative overflow-hidden rounded-xl group">
        <img src="{{ asset('images/' . $image) }}"
            class="w-full h-auto object-cover group-hover:scale-110 transition-transform duration-500"
            alt="{{ $title }}">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-4">
            <h3 class="red-hat-display font-semibold text-lg text-beige">{{ $title }}</h3>
        </div>
    </div>
</div>