@php
    $baseClasses = 'rounded px-3 py-1 text-xs font-semibold uppercase border-2';

    $rarity = trim($slot); 

    $colorClasses = '';

    switch ($rarity) {
        case 'Common':
            $colorClasses = 'bg-stone-500/30 text-stone-200 border-stone-500/50';
            break;
        case 'Uncommon':
            $colorClasses = 'bg-green-500/30 text-green-200 border-green-500/50';
            break;
        case 'Rare':
            $colorClasses = 'bg-blue-500/30 text-blue-200 border-blue-500/50';
            break;
        case 'Epic':
            $colorClasses = 'bg-yellow-400/30 text-yellow-100 border-yellow-400/50';
            break;
        case 'Legendary':
            $colorClasses = 'bg-orange-500/30 text-orange-200 border-orange-500/50';
            break;
        case 'Mythic':
            $colorClasses = 'bg-red-500/30 text-red-200 border-red-500/50';
            break;
        case 'Secret':
            $colorClasses = 'bg-purple-500/30 text-purple-200 border-purple-500/50';
            break;
        default:
            $colorClasses = 'bg-white/10 text-white border-white/20';
    }
@endphp


<span {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorClasses]) }}>
    {{ $slot }}
</span>