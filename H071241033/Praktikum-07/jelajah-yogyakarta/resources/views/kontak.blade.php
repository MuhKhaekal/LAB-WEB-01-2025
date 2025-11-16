@extends('layouts.master')
@section('content')
    <section class="absolute h-screen w-full bg-mocha overflow-hidden">
        <div class="h-full" data-aos="fade-zoom-in" data-aos-duration="1000">
            {{-- Garis atas --}}
            <div class="border-b-2 border-beige h-[70px]">
            </div>
    
            {{-- Garis samping, teks, dan gambar --}}
            <div class="grid grid-rows-2 border-l-2 border-beige h-full mx-20 pb-[150px] relative">
                <h1 class="red-hat-display font-bold text-6xl text-beige flex items-end pl-10 pb-4 leading-tight">
                    Let's get<br>in touch
                </h1>
                <img src="{{ asset('images/bg-collab.jpg') }}" alt="bg work" class="w-full object-cover brightness-90">
            </div>
    
            {{-- Form --}}
            <div class="absolute top-[70px] bottom-[70px] left-[40%] w-[50%] bg-black/10 backdrop-blur-2xl text-mocha p-10 flex items-center">
                <form class="space-y-6 w-full">
                    <div class="grid grid-cols-2 gap-6">
                        <input type="text" placeholder="Full Name"
                            class="text-beige border-b border-beige bg-transparent focus:outline-none py-2 placeholder:text-white/70">
                        <input type="email" placeholder="Email"
                            class="text-beige border-b border-beige bg-transparent focus:outline-none py-2 placeholder:text-white/70">
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <input type="text" placeholder="Phone"
                            class="text-beige border-b border-beige bg-transparent focus:outline-none py-2 placeholder:text-white/70">
                        <input type="text" placeholder="Subject"
                            class="text-beige border-b border-beige bg-transparent focus:outline-none py-2 placeholder:text-white/70">
                    </div>
                    <textarea placeholder="Tell us about what you are interested in"
                        class="w-full text-beige border-b border-beige bg-transparent focus:outline-none py-2 placeholder:text-white/70 resize-none h-24"></textarea>
    
                    <button type="submit"
                        class="bg-beige text-mocha w-full font-semibold py-3 px-6 rounded-2xl hover:bg-sekunder hover:text-beige transition-all ease-in duration-200">
                        Send to us
                    </button>
    
                    <div>
    
                    </div>
                </form>
            </div>
    
            {{-- New footer --}}
            <div class="absolute bottom-0 left-20 right-20 bg-beige text-mocha py-6 px-20 h-[70px] flex justify-between items-center text-sm">
                <a href="">
                    <p class="font-semibold">Phone</p>
                    <p>+62 8781-2170-240</p>
                </a>
                <a href="">
                    <p class="font-semibold">Email</p>
                    <p>jelajahnusantara@gmail.id</p>
                </a>
                <a href="">
                    <p class="font-semibold">Address</p>
                    <p>Jl. Perintis Kemerdekaan</p>
                </a>
            </div>
        </div>
    </section>
@endsection
