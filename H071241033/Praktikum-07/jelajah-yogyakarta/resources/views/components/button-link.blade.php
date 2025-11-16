@props([
    'href',
    'borderColor' => 'border-mocha',
    'textColor' => 'text-mocha'
])

<a href="{{ $href }}" target="_blank"
    class="inline-block border {{ $borderColor }} {{ $textColor }} hover:bg-sekunder hover:border-sekunder hover:text-beige red-hat-display  text-sm px-5 py-2  transition-all duration-300 ease-in-out">
    {{ $slot }}
</a>