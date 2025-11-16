@extends('layouts.app')

@section('title', 'Add New Fish')

{{-- @section('body-class', 'bg-index') --}}

@section('content')
    <div class="flex flex-col items-center" data-aos="fade-zoom-in" data-aos-duration="500">
        <h1 class="text-4xl font-semibold text-white mb-8 text-center">Add a New Fish</h1>
        <div class="w-full max-w-4xl rounded-xl border border-white/20 bg-white/10 p-8 shadow-xl backdrop-blur-sm">
            <form method="POST" action="{{ route('fishes.store') }}" id="fishForm" class="flex w-full gap-6">
                @csrf
                <div class="flex w-2/3 flex-col justify-center space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-200">
                            Fish Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-xl border border-white/20 px-4 py-2 text-sm text-white shadow-lg backdrop-blur-sm focus:outline-none focus:ring-1 focus:ring-white/50 @error('name') border-red-400 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rarity" class="block text-sm font-medium text-gray-200">Rarity <span
                                class="text-red-400">*</span></label>
                        <select name="rarity" id="rarity" required
                            class="mt-1 block w-full appearance-none rounded-xl border border-white/20 px-4 py-2 text-sm text-white shadow-lg backdrop-blur-md focus:outline-none focus:ring-1 focus:ring-white/50 @error('rarity') border-red-400 @enderror">

                            <option value="" class="bg-indigo-950" disabled selected>Select Rarity</option>
                            <option value="Common" class="bg-indigo-950" {{ old('rarity') == 'Common' ? 'selected' : '' }}>Common</option>
                            <option value="Uncommon" class="bg-indigo-950" {{ old('rarity') == 'Uncommon' ? 'selected' : '' }}>Uncommon</option>
                            <option value="Rare" class="bg-indigo-950" {{ old('rarity') == 'Rare' ? 'selected' : '' }}>Rare</option>
                            <option value="Epic" class="bg-indigo-950" {{ old('rarity') == 'Epic' ? 'selected' : '' }}>Epic</option>
                            <option value="Legendary" class="bg-indigo-950" {{ old('rarity') == 'Legendary' ? 'selected' : '' }}>Legendary</option>
                            <option value="Mythic" class="bg-indigo-950" {{ old('rarity') == 'Mythic' ? 'selected' : '' }}>Mythic</option>
                            <option value="Secret" class="bg-indigo-950" {{ old('rarity') == 'Secret' ? 'selected' : '' }}>Secret</option>
                        </select>
                        @error('rarity')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="base_weight_min" class="block text-sm font-medium text-gray-200">Min Weight (kg) <span class="text-red-400">*</span></label>
                            <input type="number" step="0.01" name="base_weight_min" id="base_weight_min"
                                value="{{ old('base_weight_min') }}" required
                                class="mt-1 block w-full rounded-xl border border-white/20 px-4 py-2 text-sm text-white shadow-lg backdrop-blur-md focus:outline-none focus:ring-1 focus:ring-white/50 
                                @error ('base_weight_min') border-red-400 @enderror">
                            @error('base_weight_min')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="base_weight_max" class="block text-sm font-medium text-gray-200">Max Weight (kg) <span
                                    class="text-red-400">*</span></label>
                            <input type="number" step="0.01" name="base_weight_max" id="base_weight_max"
                                value="{{ old('base_weight_max') }}" required
                                class="mt-1 block w-full rounded-xl border border-white/20 px-4 py-2 text-sm text-white shadow-lg backdrop-blur-md focus:outline-none focus:ring-1 focus:ring-white/50 
                                @error ('base_weight_max') border-red-400 @enderror">
                            @error('base_weight_max')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="sell_price_per_kg" class="block text-sm font-medium text-gray-200">Price/kg (Coins)
                                <span class="text-red-400">*</span></label>
                            <input type="number" name="sell_price_per_kg" id="sell_price_per_kg"
                                value="{{ old('sell_price_per_kg') }}" required
                                class="mt-1 block w-full rounded-xl border border-white/20 px-4 py-2 text-sm text-white shadow-lg backdrop-blur-md focus:outline-none focus:ring-1 focus:ring-white/50 @error('sell_price_per_kg') border-red-400 @enderror">
                            @error('sell_price_per_kg')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="catch_probability" class="block text-sm font-medium text-gray-200">Catch Probability (%)
                                <span class="text-red-400">*</span></label>
                            <input type="number" step="0.01" name="catch_probability" id="catch_probability"
                                value="{{ old('catch_probability') }}" required
                                class="mt-1 block w-full rounded-xl border border-white/20 px-4 py-2 text-sm text-white shadow-lg backdrop-blur-md focus:outline-none focus:ring-1 focus:ring-white/50 @error('catch_probability') border-red-400 @enderror"
                                placeholder="e.g., 25.50">
                            @error('catch_probability')
                                {{-- Ini validasi 'min:0.01|max:100' --}}
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex w-1/3 flex-col">
                    <label for="description" class="block text-sm font-medium text-gray-200">Description (optional)</label>
                    <textarea name="description" id="description"
                        class="mt-1 block w-full flex-grow rounded-xl border border-white/20 px-4 py-3 text-sm text-white shadow-lg backdrop-blur-md focus:outline-none focus:ring-1 focus:ring-white/50 @error('description') border-red-400 @enderror"
                        placeholder="Optional fish description...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
            </form>
            <div class="flex justify-end gap-4 pt-10">
                <x-glass-button href="{{ route('fishes.index') }}">
                    Cancel
                </x-glass-button>
                <x-glass-button type="submit" form="fishForm" bg="bg-white" class="font-semibold">
                    Save Fish
                </x-glass-button>
            </div>
        </div>
    </div>
@endsection