@extends('layouts.master')

@section('title', 'Destinasi Wisata - Eksplor Pariwisata Malang')

@section('content')
<div class="bg-[#FFF9E2]">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h1 class="text-2xl font-bold text-gray-900 mt-6 mb-2">Destinasi Wisata</h1>
            <div class="w-20 h-1 bg-[#DCA278] mx-auto mb-6"></div>
            <p class="text-xl text-gray-600">
                Temukan tempat-tempat menakjubkan di Malang dan sekitarnya
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($destinations as $destination)
                <x-card 
                    :title="$destination['name']"
                    :image="$destination['image']"
                    :description="$destination['description']"
                />
            @endforeach
        </div>        
    </div>
</div>
@endsection