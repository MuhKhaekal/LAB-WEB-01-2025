@extends('layouts.app')

@section('title', 'Tambah Ikan Baru')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold text-[#EC802B]">Tambah Ikan Baru</h2>
    <p class="text-white mt-2">catatan : field dengan <span class="text-red-500">*</span> wajib diisi</p>
</div>

<div class="bg-[#66BCB4] rounded-lg shadow-md p-8">
    <form method="POST" action="{{ route('fishes.store') }}">
        @csrf
        <div class="mb-6">
            <label class="block text-sm font-medium text-white mb-2">
                Nama Ikan <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   name="name" 
                   class="w-full px-4 py-2 border @error('name') border-red-500 @else border-[#EDC55B] @enderror rounded-lg" 
                   value="{{ old('name') }}" 
                   placeholder="Contoh: Tuna Sirip Kuning"
                   required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rarity -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-white mb-2">
                Rarity <span class="text-red-500">*</span>
            </label>
            <select name="rarity" 
                    class="w-full px-4 py-2 border @error('rarity') border-red-500 @else border-[#EDC55B] @enderror rounded-lg" 
                    required>
                <option value="">Pilih Rarity</option>
                @foreach($rarities as $rarity)
                    <option value="{{ $rarity }}" {{ old('rarity') == $rarity ? 'selected' : '' }}>
                        {{ $rarity }}
                    </option>
                @endforeach
            </select>
            @error('rarity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-white text-sm mt-1">7 tingkat: Common, Uncommon, Rare, Epic, Legendary, Mythic, Secret</p>
        </div>

        <!-- Berat Minimum & Maksimum -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-white mb-2">
                    Berat Minimum (kg) <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       step="0.01" 
                       name="base_weight_min" 
                       class="w-full px-4 py-2 border @error('base_weight_min') border-red-500 @else border-[#EDC55B] @enderror rounded-lg" 
                       value="{{ old('base_weight_min') }}" 
                       placeholder="Contoh: 0.5"
                       required>
                @error('base_weight_min')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white mb-2">
                    Berat Maksimum (kg) <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       step="0.01" 
                       name="base_weight_max" 
                       class="w-full px-4 py-2 border @error('base_weight_max') border-red-500 @else border-[#EDC55B] @enderror rounded-lg" 
                       value="{{ old('base_weight_max') }}" 
                       placeholder="Contoh: 2.5"
                       required>
                @error('base_weight_max')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-white text-sm mt-1">Harus lebih besar dari berat minimum</p>
            </div>
        </div>

        <!-- Harga Jual & Probabilitas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-white mb-2">
                    Harga Jual per kg (Coins) <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       name="sell_price_per_kg" 
                       class="w-full px-4 py-2 border @error('sell_price_per_kg') border-red-500 @else border-[#EDC55B] @enderror rounded-lg" 
                       value="{{ old('sell_price_per_kg') }}" 
                       placeholder="Contoh: 1500"
                       required>
                @error('sell_price_per_kg')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white mb-2">
                    Peluang Tertangkap (%) <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       step="0.01" 
                       name="catch_probability" 
                       class="w-full px-4 py-2 border @error('catch_probability') border-red-500 @else border-[#EDC55B] @enderror rounded-lg" 
                       value="{{ old('catch_probability') }}" 
                       placeholder="Contoh: 15.50"
                       min="0.01"
                       max="100"
                       required>
                @error('catch_probability')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-white text-sm mt-1">Antara 0.01% - 100%</p>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-white mb-2">
                Deskripsi <span class="text-white">(opsional)</span>
            </label>
            <textarea name="description" 
                      rows="4" 
                      class="w-full px-4 py-2 border @error('description') border-red-500 @else border-[#EDC55B] @enderror rounded-lg" 
                      placeholder="Tambahkan deskripsi tentang ikan ini...">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="bg-[#EC802B] hover:bg-[#E8CCAD] text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                Simpan Ikan
            </button>
            <a href="{{ route('fishes.index') }}" class="bg-red-500 hover:bg-[#E8CCAD] text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection