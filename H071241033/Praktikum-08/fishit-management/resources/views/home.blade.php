@extends('layouts.app')

@section('title', 'Welcome to Fish It Simulator')

@section('body-class', 'bg-index')
@section('content')
    <section>
        <div class="flex flex-col justify-center items-center text-white mt-10">
            <div data-aos="fade-zoom-in" data-aos-duration="2000">
                <h2 class="border border-white/20 rounded-4xl px-4 py-2 shadow-xl backdrop-blur-lg tracking-wide">
                    Manage Your Virtual Aquarium with Ease
                </h2>
            </div>
            <div class="flex flex-col justify-center items-center mt-5 text-center" data-aos="fade-zoom-in" data-aos-duration="2000">
                <h1 class="font-semibold text-5xl leading-tight">
                    Manage Fish Data Effortlessly<br>with FishBase
                </h1>
                <p class="text-center w-3/4 mt-6 tracking-wide">
                    Record, analyze, and organize every fish detail — from rarity to catch rate — in one simple dashboard. Fish It helps you track your collection like a pro, so you can focus on what truly matters: the game.
                </p>
            </div>

            <div class="flex flex-row gap-5 mt-8" data-aos="fade-up" data-aos-duration="600" data-aos-delay="500" data-aos-easing="ease-out">
                <x-glass-button href="{{ route('fishes.index') }}">
                    Open Dashboard →
                </x-glass-button>

                <x-glass-button href="{{ route('fishes.create') }}" bg="bg-white" class="font-semibold">
                    Add New Fish →
                </x-glass-button>
            </div>
        </div>
    </section>
@endsection