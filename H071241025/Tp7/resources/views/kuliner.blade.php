@extends('layouts.master')

@section('title', 'Kuliner Khas - Eksplor Pariwisata Malang')

@section('content')
<div class="bg-[#FFF9E2]">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h1 class="text-2xl font-bold text-gray-900 mt-6 mb-2">Kuliner Khas</h1>
            <div class="w-20 h-1 bg-[#DCA278] mx-auto mb-6"></div>
            <p class="text-xl text-gray-600">
                Nikmati kelezatan makanan khas yang akan memanjakan lidah Anda
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($foods as $food)
                <x-card 
                    :title="$food['name']"
                    :image="$food['image']"
                    :description="$food['description']"
                />
            @endforeach
        </div>

        <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-8">
            <div class="bg-[#EBECCC] border border-gray-200 p-8 rounded-xl">
                <div class="flex items-center mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">Rekomendasi Tempat Makan</h3>
                </div>
                <div class="space-y-3 text-gray-700">
                    <div class="flex items-start">
                        <span class="text-[#] mr-2">•</span>
                        <span>Bakso President - Jl. Bendungan Sigura-gura</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-[#] mr-2">•</span>
                        <span>Rawon Nguling - Jl. Panglima Sudirman</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-[#] mr-2">•</span>
                        <span>Depot Cwie Mie - Jl. Basuki Rahmat</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-[#] mr-2">•</span>
                        <span>Pasar Buah & Apel - Jl. A. Yani</span>
                    </div>
                </div>
            </div>

            <div class="bg-[#EBECCC] border border-gray-200 p-8 rounded-xl">
                <div class="flex items-center mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">Oleh-oleh Khas</h3>
                </div>
                <div class="space-y-3 text-gray-700">
                    <div class="flex items-start">
                        <span class="text-[#] mr-2">•</span>
                        <span>Keripik Apel & Tempe</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-[#] mr-2">•</span>
                        <span>Susu Murni Nasional</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-[#] mr-2">•</span>
                        <span>Bakpia Malang</span>
                    </div>
                    <div class="flex items-start">
                        <span class="text-[#] mr-2">•</span>
                        <span>Kopi Kawi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection