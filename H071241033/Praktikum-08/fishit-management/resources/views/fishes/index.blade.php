@extends('layouts.app')

@section('title', 'FishBase Dashboard')

@section('content')
    <section>
        <div class="relative flex flex-col items-center text-center text-white">
            <h1 class="font-semibold text-3xl" data-aos="fade-zoom-in">
                Manage and Monitor Your Collection
            </h1>
            <div class="absolute mt-16 z-10" data-aos="zoom-out" data-aos-duration="500" data-aos-delay="350" data-aos-easing="ease-out">
                <x-glass-button href="{{ route('fishes.create') }}" bg="bg-white" class="font-semibold">
                    + Add New Fish
                </x-glass-button>
            </div>
        </div>
    </section>

    <section class="font-zalando-sans">
        <div class="my-8">
            <form method="GET" action="{{ route('fishes.index') }}" class="flex flex-col gap-1 text-white"  data-aos="fade-down" data-aos-duration="500" data-aos-ease="ease-out">
                <label for="rarity" class="text-md font-medium text-white mb-2">Filter by Rarity :</label>
                <select name="rarity" id="rarity"
                    class="w-1/5 rounded-xl border border-white/20 bg-white/10 text-sm px-3 py-2 shadow-lg backdrop-blur-md focus:outline-none focus:ring-2 focus:ring-white/50"
                    onchange="this.form.submit()">
                    <option value="" class="bg-indigo-950">All Rarities</option>
                    <option value="Common" class="bg-indigo-950" {{ request('rarity') == 'Common' ? 'selected' : '' }}>Common</option>
                    <option value="Uncommon" class="bg-indigo-950" {{ request('rarity') == 'Uncommon' ? 'selected' : '' }}>Uncommon</option>
                    <option value="Rare" class="bg-indigo-950" {{ request('rarity') == 'Rare' ? 'selected' : '' }}>Rare</option>
                    <option value="Epic" class="bg-indigo-950" {{ request('rarity') == 'Epic' ? 'selected' : '' }}>Epic</option>
                    <option value="Legendary" class="bg-indigo-950" {{ request('rarity') == 'Legendary' ? 'selected' : '' }}>Legendary</option>
                    <option value="Mythic" class="bg-indigo-950" {{ request('rarity') == 'Mythic' ? 'selected' : '' }}>Mythic</option>
                    <option value="Secret" class="bg-indigo-950" {{ request('rarity') == 'Secret' ? 'selected' : '' }}>Secret</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mb-16" data-aos="fade-up" data-aos-duration="500" data-aos-ease="ease-out">
            @forelse ($fishes as $fish)
            {{-- per satu kartu --}}
            <div class="flex flex-col justify-between rounded-xl border border-white/20 bg-white/5 shadow-xl backdrop-blur-lg overflow-hidden h-full">
                {{-- bagian atas kartu --}}
                <div class="p-4 text-white flex flex-col justify-between">
                    {{-- nama dan rarity --}}
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold">{{ $fish->name }}</h3>
                            <x-rarity-badge>
                                {{ $fish->rarity }}
                            </x-rarity-badge>
                        </div>
                    </div>
                    {{-- info stats --}}
                    <div class="space-y-2 text-xs text-gray-200 mt-auto">
                        <div class="flex justify-between">
                            <span>Price/kg:</span>
                            <span class="font-medium">{{ $fish->sell_price_per_kg }} Coins</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Probability:</span>
                            <span class="font-medium">{{ $fish->catch_probability }} %</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Weight:</span>
                            <span class="font-medium">{{ $fish->base_weight_min }} - {{ $fish->base_weight_max }} kg</span>
                        </div>
                    </div>
                </div>
                {{-- tombol aksi --}}
                <div class="flex justify-end space-x-3 px-3 py-4 border-t border-white/20">
                    <a href="{{ route('fishes.show', $fish) }}"
                        class="flex justify-center items-center rounded-full border border-white/20 bg-blue-700/10 px-3 py-1 font-medium text-sm text-blue-400 hover:bg-blue-500/20 active:scale-90" >View</a>
                    <a href="{{ route('fishes.edit', $fish) }}"
                        class="flex justify-center items-center rounded-full border border-white/20 bg-yellow-700/10 px-3 py-1 font-medium text-sm text-yellow-400 hover:bg-yellow-500/20 active:scale-90">Edit</a>
                    <x-confirm-delete-modal actionUrl="{{ route('fishes.destroy', $fish) }}">
                        <div class="cursor-pointer flex justify-center items-center rounded-full border border-white/20 bg-red-700/10 px-3 py-1 font-medium text-sm text-red-400 hover:bg-red-600/20">
                            Delete
                        </div>
                    </x-confirm-delete-modal>
                </div>
            </div>
            @empty
            <div class="sm:col-span-2 md:col-span-3 lg:col-span-4 text-center text-gray-300 py-16">
                <h2 class="text-2xl font-semibold">No Fish Found</h2>
                <p class="mt-2">Try adding a new fish, or clear your filter.</p>
            </div>
            @endforelse
        </div>

        {{-- Paginasi --}}
        <div class="mb-26 flex flex-col justify-center text-white">
            {{ $fishes->appends(request()->query())->links() }}
        </div>
    </section>
@endsection