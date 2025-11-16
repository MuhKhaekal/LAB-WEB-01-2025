@extends('layouts.app')

@section('title', 'Detail: ' . $fish->name)

@section('content')
    <div class="flex flex-col items-center mb-12 text-white" data-aos="fade-zoom-in" data-aos-duration="500">

        <div class="w-full max-w-4xl mb-6">
            <x-glass-button href="{{ route('fishes.index') }}">
                &larr; Back to Dashboard
            </x-glass-button>
        </div>

        <div class="w-full max-w-4xl rounded-xl border border-white/20 bg-white/10 shadow-xl backdrop-blur-sm overflow-hidden">
            
            <div class="p-4 md:py-3 md:px-8  border-b border-white/20">
                <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                    <div class="flex flex-row items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                        class="fill-current w-12 h-12"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M275.2 38.4c-10.6-8-25-8.5-36.3-1.5S222 57.3 224.6 70.3l9.7 48.6c-19.4 9-36.9 19.9-52.4 31.5-15.3 11.5-29 23.9-40.7 36.3L48.1 132.4c-12.5-7.3-28.4-5.3-38.7 4.9s-12.4 26-5.3 38.6L50 256 4.2 336.1c-7.2 12.6-5 28.4 5.3 38.6s26.1 12.2 38.7 4.9l93.1-54.3c11.8 12.3 25.4 24.8 40.7 36.3 15.5 11.6 33 22.5 52.4 31.5l-9.7 48.6c-2.6 13 3.1 26.3 14.3 33.3s25.6 6.5 36.3-1.5l77.6-58.2c54.9-4 101.5-27 137.2-53.8 39.2-29.4 67.2-64.7 81.6-89.5 5.8-9.9 5.8-22.2 0-32.1-14.4-24.8-42.5-60.1-81.6-89.5-35.8-26.8-82.3-49.8-137.2-53.8L275.2 38.4zM384 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
                        <h1 class="text-3xl md:text-3xl font-semibold">{{ $fish->name }}</h1>
                    </div>
                    <x-rarity-badge class="shrink-0 text-sm">
                        {{ $fish->rarity }}
                    </x-rarity-badge>
                </div>
            </div>
            
            <div class="p-6 md:py-5 md:px-8 space-y-6">
                
                <div>
                    <h2 class="text-xl font-semibold mb-2">Description</h2>
                    <p class="text-gray-200 leading-relaxed text-sm">
                        {{ $fish->description ?? 'No description provided for this fish.' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    
                    <div class="flex justify-between items-center border-b border-white/10 py-2">
                        <span class="text-sm">Min Weight:</span>
                        <span class="text-gray-200 font-medium">{{ $fish->base_weight_min }} kg</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-white/10 py-2">
                        <span class="text-sm">Max Weight:</span>
                        <span class="text-gray-200 font-medium">{{ $fish->base_weight_max }} kg</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-white/10 py-2">
                        <span class="text-sm">Price/kg (Coins):</span>
                        <span class="text-gray-200 font-medium">{{ $fish->sell_price_per_kg }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-white/10 py-2">
                        <span class="text-sm">Catch Probability:</span>
                        <span class="text-gray-200 font-medium">{{ $fish->catch_probability }} %</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-white/10 py-2">
                        <span class="text-sm">Created At:</span>
                        <span class="text-gray-200 font-medium">{{ $fish->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-white/10 py-2">
                        <span class="text-sm">Last Updated:</span>
                        <span class="text-gray-200 font-medium">{{ $fish->updated_at->format('d M Y, H:i') }}</span>
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 px-8 py-5">
                <a href="{{ route('fishes.edit', $fish) }}"
                    class="flex justify-center items-center rounded-full border border-white/20 bg-yellow-600/20 px-4 py-2 font-medium text-md text-yellow-400 hover:bg-yellow-500/20">Edit</a>
                <x-confirm-delete-modal actionUrl="{{ route('fishes.destroy', $fish) }}">
                        <div class="cursor-pointer flex justify-center items-center rounded-full border border-white/20 bg-red-700/20 px-4 py-2 font-medium text-md text-red-400 hover:bg-red-500/20">
                            Delete
                        </div>
                </x-confirm-delete-modal>
            </div>

        </div>
    </div>
@endsection