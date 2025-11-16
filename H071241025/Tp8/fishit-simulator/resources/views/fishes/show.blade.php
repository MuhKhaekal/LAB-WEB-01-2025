@extends('layouts.app')

@section('title', 'Detail Ikan' . $fish->name)

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold text-[#EC802B]">Detail Ikan</h2>
</div>

<div class="bg-[#66BCB4] rounded-lg shadow-md overflow-hidden">
    <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <table class="w-full border border-[#EDC55B] rounded-lg overflow-hidden">
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-bold text-white w-2/5">ID</th>
                        <td class="bg-white px-4 py-3">{{ $fish->id }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-bold text-white">Nama Ikan</th>
                        <td class="bg-white px-4 py-3 text-lg">{{ $fish->name }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-bold text-white">Rarity</th>
                        <td class="bg-white px-4 py-3">{{ $fish->rarity }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-bold text-white">Berat Minimum</th>
                        <td class="bg-white px-4 py-3">{{ $fish->base_weight_min }} kg</td>
                    </tr>
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-bold text-white">Berat Maksimum</th>
                        <td class="bg-white px-4 py-3">{{ $fish->base_weight_max }} kg</td>
                    </tr>
                    <tr>
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-bold text-white">Range Berat</th>
                        <td class="bg-white px-4 py-3">{{ $fish->weight_range }}</td>
                    </tr>
                </table>
            </div>

            <div>
                <table class="w-full border border-[#EDC55B] rounded-lg overflow-hidden">
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-bold text-white w-2/5">Harga Jual per kg</th>
                        <td class="bg-white px-4 py-3">{{ number_format($fish->sell_price_per_kg, 0, ',', '.') }} Coins/kg</td>
                    </tr>
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-semibold text-white">Formatted Price</th>
                        <td class="bg-white px-4 py-3">{{ $fish->formatted_price }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-semibold text-white">Peluang Tertangkap</th>
                        <td class="bg-white px-4 py-3">{{ $fish->catch_probability }}%</td>
                    </tr>
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-semibold text-white">Dibuat Pada</th>
                        <td class="bg-white px-4 py-3">{{ $fish->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-semibold text-white">Terakhir Diupdate</th>
                        <td class="bg-white px-4 py-3">{{ $fish->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-[#EC802B] px-4 py-3 text-left text-sm font-semibold text-white">Waktu Update</th>
                        <td class="bg-white px-4 py-3">
                            {{ $fish->updated_at->diffForHumans() }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mt-8">
            <h5 class="text-xl font-bold text-[#EC802B] border-b-2 border-[#EDC55B] pb-2 mb-4">Deskripsi Ikan</h5>
            @if($fish->description)
                <p class="text-white leading-relaxed">{{ $fish->description }}</p>
            @else
                <p class="text-white italic">Tidak ada deskripsi untuk ikan ini.</p>
            @endif
        </div>

        <!-- Statistik Estimasi -->
        <div class="mt-8">
            <h5 class="text-xl font-bold text-[#EC802B] border-b-2 border-[#EDC55B] pb-2 mb-4">Statistik Estimasi</h5>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-6 text-center border border-green-200">
                    <h6 class="text-sm font-medium mb-2">Harga Min (Berat Min)</h6>
                    <h4 class="text-2xl font-bold text-green-700">
                        {{ number_format($fish->base_weight_min * $fish->sell_price_per_kg, 0, ',', '.') }} Coins
                    </h4>
                </div>
                <div class="bg-white rounded-lg p-6 text-center border border-blue-200">
                    <h6 class="text-sm font-medium mb-2">Harga Max (Berat Max)</h6>
                    <h4 class="text-2xl font-bold text-green-700">
                        {{ number_format($fish->base_weight_max * $fish->sell_price_per_kg, 0, ',', '.') }} Coins
                    </h4>
                </div>
                <div class="bg-white rounded-lg p-6 text-center border border-purple-200">
                    <h6 class="text-sm font-medium mb-2">Harga Rata-rata</h6>
                    <h4 class="text-2xl font-bold text-green-700">
                        {{ number_format((($fish->base_weight_min + $fish->base_weight_max) / 2) * $fish->sell_price_per_kg, 0, ',', '.') }} Coins
                    </h4>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mt-8">
            <a href="{{ route('fishes.edit', $fish) }}" class="bg-[#EC802B] hover:bg-[#EDC55B] text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                Edit Ikan
            </a>
            <form method="POST" 
                  action="{{ route('fishes.destroy', $fish) }}" 
                  class="inline"
                  onsubmit="return confirm('Yakin ingin menghapus {{ $fish->name }}? Data tidak bisa dikembalikan!')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                    Hapus Ikan
                </button>
            </form>
            <a href="{{ route('fishes.index') }}" class="bg-[#EC802B] hover:bg-[#EDC55B] text-white font-semibold px-6 py-3 rounded-lg shadow transition ml-auto">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection