@props([
    'image',
    'alt',
    'category',
    'title',
    'layout' => 'image-left', // Kita buat 'image-left' sebagai default
    'href' => null
])

<div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
    <div data-aos="{{ $layout === 'image-left' ? 'fade-right' : 'fade-left' }}" 
        data-aos-duration="800"
        class="{{ $layout === 'image-right' ? 'md:order-last' : '' }}">
        <img src="{{ asset('images/' . $image) }}" alt="{{ $alt }}"
            class="w-full h-auto max-h-[400px] max-w-[500px] object-cover rounded-lg shadow-xl">
    </div>
    <div data-aos="{{ $layout === 'image-left' ? 'fade-left' : 'fade-right' }}" 
        data-aos-duration="800"
        class="flex flex-col justify-center h-full">
        <div>
            <span class="red-hat-display font-semibold text-sekunder text-lg">{{ $category }}</span>
            <h2 class="playfair-display font-bold text-3xl text-mocha mt-2 mb-4">{{ $title }}</h2>
            {{ $slot }}
        </div>
        @if ($href)
        <div class="mt-6">
            <x-button-link :href="$href">
                More about {{ $title }}
            </x-button-link>
        </div>
        @endif
    </div>
</div>