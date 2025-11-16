@props([
    'href' => null, 
    'bg' => null,
    'textColor' => null,
])

@php
    $baseClasses = 'cursor-pointer inline-block border-2 border-white/20 rounded-full px-4 py-2 shadow-xl backdrop-blur-lg font-medium transition-all duration-300 active:scale-90';
    // $hoverClass = '';

    if ($bg) {
        $textColorClass = $textColor ?? 'text-dark-purple';
        // $hoverClass = 'hover:bg-gray-200';
    } else {
        $textColorClass = $textColor ?? 'text-white';
        // $hoverClass = 'hover:bg-white/20'; 
    }

    $bgClass = $bg ?? '';

    $finalClasses = $baseClasses . ' ' . $bgClass . ' ' . $textColorClass;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $finalClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $finalClasses]) }}>
        {{ $slot }} 
    </button>
@endif
