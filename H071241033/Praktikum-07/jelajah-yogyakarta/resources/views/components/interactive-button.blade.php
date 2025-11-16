@props([
    'href' => null,
    'color' => '#3b3b3b',
])
{{-- ========================================= --}}
{{-- KAYAKNYA INI GA KEPAKE JADI BOLEH DIHAPUS --}}
{{-- ========================================= --}}
@if ($href)
    <a href="{{ $href }}" style="--clr: {{ $color }}
        {{ $attributes->merge(['class' => 'button']) }}">
        <span class="button__icon-wrapper">

            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon-svg"
                width="14">
                <path d="M12 4V20M12 20L18 14M12 20L6 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>

            <svg viewBox="0 0 24 24" fill="none" width="14" xmlns="http://www.w3.org/2000/svg"
                class="button__icon-svg button__icon-svg--copy">
                <path d="M12 4V20M12 20L18 14M12 20L6 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>

        </span>

        {{ $slot }}
    </a>
@else
    <button type="button" style="--clr: {{ $color }}
        {{ $attributes->merge(['class' => 'button']) }}">
        <span class="button__icon-wrapper">

            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon-svg"
                width="14">
                <path d="M12 4V20M12 20L18 14M12 20L6 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>

            <svg viewBox="0 0 24 24" fill="none" width="14" xmlns="http://www.w3.org/2000/svg"
                class="button__icon-svg button__icon-svg--copy">
                <path d="M12 4V20M12 20L18 14M12 20L6 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>

        </span>

        {{ $slot }}
    </button>
