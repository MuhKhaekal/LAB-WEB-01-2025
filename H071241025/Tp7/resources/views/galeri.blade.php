@extends('layouts.master')

@section('title', 'Galeri Foto - Eksplor Pariwisata Malang')

@section('content')
<div class="bg-[#FFF9E2]">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h1 class="text-2xl font-bold text-gray-900 mt-6 mb-2">Galeri Foto</h1>
            <div class="w-20 h-1 bg-[#DCA278] mx-auto mb-6"></div>
            <p class="text-xl text-gray-600">
                Lihat keindahan Malang melalui lensa kamera
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-20">
            @foreach($galleries as $gallery)
                <div class="relative group overflow-hidden rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <img src="{{ asset('images/' . $gallery['image']) }}" 
                         alt="{{ $gallery['caption'] }}"
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <p class="text-white font-medium p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            {{ $gallery['caption'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="bg-[#EBECCC] rounded-xl p-12 text-center">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Bagikan Momen Anda</h3>
                <p class="text-lg text-gray-600 mb-6">
                    Punya foto menarik saat berkunjung ke Malang? <br>
                    Bagikan dengan hashtag <span class="font-semibold text-[#DCA278]">#EksplorMalang</span>
                </p>
                <div class="flex justify-center space-x-3 text-4xl">
                    <span class="hover:scale-110 transition-transform duration-300">📸</span>
                    <span class="hover:scale-110 transition-transform duration-300">🏔️</span>
                    <span class="hover:scale-110 transition-transform duration-300">🍜</span>
                    <span class="hover:scale-110 transition-transform duration-300">🌄</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection