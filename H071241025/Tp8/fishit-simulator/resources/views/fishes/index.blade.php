@extends('layouts.app')

@section('title', 'Fish Database')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <h2 class="text-2xl font-bold text-[#EC802B]">Fish Database</h2>
    <a href="{{ route('fishes.create') }}" class="bg-[#EC802B] hover:bg-[#E8CCAD] text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition transform hover:scale-105">
        Tambah Ikan Baru
    </a>
</div>

<div class="bg-[#66BCB4] rounded-lg shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('fishes.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-white mb-2">Search Nama Ikan</label>
                <input type="text" 
                       name="search" 
                       class="w-full px-4 py-2 border border-[#EDC55B] rounded-lg focus:ring-2 focus:ring-[#EDC55B] focus:border-transparent" 
                       placeholder="Cari nama ikan" 
                       value="{{ request('search') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-white mb-2">Filter Rarity</label>
                <select name="rarity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EDC55B] focus:border-transparent">
                    <option value="">Semua Rarity</option>
                    @foreach($rarities as $rarity)
                        <option value="{{ $rarity }}" {{ request('rarity') == $rarity ? 'selected' : '' }}>
                            {{ $rarity }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-sm font-medium text-white mb-2">Urutkan Berdasarkan</label>
                <select name="sort_by" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EDC55B] focus:border-transparent">
                    <option value="">Terbaru</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama</option>
                    <option value="sell_price_per_kg" {{ request('sort_by') == 'sell_price_per_kg' ? 'selected' : '' }}>Harga</option>
                    <option value="catch_probability" {{ request('sort_by') == 'catch_probability' ? 'selected' : '' }}>Probabilitas</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-[#EC802B] hover:bg-[#E8CCAD] text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    Cari Berdasarkan Filter
                </button>
            </div>
        </div>

        @if(request('search') || request('rarity') || request('sort_by'))
            <div class="mt-4">
                <a href="{{ route('fishes.index') }}" class="bg-[#EC802B] text-sm text-white hover:bg-[#E8CCAD] p-2 rounded-lg font-medium">
                    Reset Filter
                </a>
            </div>
        @endif
    </form>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#EC802B] text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Ikan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Rarity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Berat (kg)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Harga/kg</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Catch Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($fishes as $fish)
                    <tr class="hover:bg-[#66BCB4] transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $fish->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold ">{{ $fish->name }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="rarity-{{ $fish->rarity }}  text-xs font-bold px-3 py-1 rounded-full">
                                {{ $fish->rarity }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ $fish->weight_range }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ $fish->formatted_price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class=" text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $fish->catch_probability }}%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('fishes.show', $fish) }}" 
                                   class="bg-[#EDC55B] hover:bg-[#66BCB4] text-white px-3 py-1 rounded transition"
                                   title="Lihat Detail">
                                    Detail
                                </a>
                                <a href="{{ route('fishes.edit', $fish) }}" 
                                   class="bg-[#EDC55B] hover:bg-[#66BCB4] text-white px-3 py-1 rounded transition"
                                   title="Edit">
                                    Edit
                                </a>
                                <form method="POST" 
                                      action="{{ route('fishes.destroy', $fish) }}" 
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus {{ $fish->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-[#66BCB4] text-white px-3 py-1 rounded transition"
                                            title="Hapus">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <p class="text-gray-500 text-lg">
                                Belum ada data ikan. 
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $fishes->links() }}
</div>

<div class="text-center mt-4">
    <p class="text-sm">
        Total: <span class="font-semibold">{{ $fishes->total() }}</span> ikan | 
        Halaman <span class="font-semibold">{{ $fishes->currentPage() }}</span> dari <span class="font-semibold">{{ $fishes->lastPage() }}</span>
    </p>
</div>
@endsection