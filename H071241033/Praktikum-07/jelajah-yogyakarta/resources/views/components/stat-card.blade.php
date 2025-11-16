@props([
    'target',
    'title',
    'suffix' => '' // Parameter opsional untuk tanda '+'
])

<div class="p-8 rounded-lg text-center transform transform-all duration-500 ease-out hover:scale-105 hover:shadow-xl hover:bg-white-bone">
    <div class="flex justify-center items-end h-20">
        <span class="counter text-6xl font-bold playfair-display text-mocha"
            data-target="{{ $target }}">0</span>
        @if($suffix)    
            <span class="text-4xl text-mocha font-bold playfair-display pb-1">{{ $suffix }}</span>
        @endif
    </div>
    <h3 class="text-2xl font-bold red-hat-display text-mocha mt-3">{{ $title }}</h3>
    <p class="red-hat-display text-gray-600 mt-2">
        {{ $slot }}
    </p>
</div>