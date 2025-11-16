@extends('layouts.master')

@section('title', 'Kontak Kami - Eksplor Pariwisata Malang')

@section('content')
<div class="bg-[#FFF9E2]">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h1 class="text-2xl font-bold text-gray-900 mt-6 mb-2">Hubungi Kami</h1>
            <div class="w-20 h-1 bg-[#DCA278] mx-auto mb-6"></div>
            <p class="text-xl text-gray-600">
                Ada pertanyaan? Jangan ragu untuk menghubungi kami
            </p>
        </div>

        <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-12">
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start space-x-4 p-4 bg-[#EBECCC] rounded-xl border border-gray-200">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                            <span class="text-2xl">📍</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#DCA278] mb-1">Alamat</h3>
                            <p class="text-gray-600">{{ $contact_info['address'] }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-[#EBECCC] rounded-xl border border-gray-200">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                            <span class="text-2xl">📞</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#DCA278] mb-1">Telepon</h3>
                            <p class="text-gray-600">{{ $contact_info['phone'] }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-[#EBECCC] rounded-xl border border-gray-200">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                            <span class="text-2xl">✉️</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#DCA278] mb-1">Email</h3>
                            <p class="text-gray-600">{{ $contact_info['email'] }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-[#EBECCC] rounded-xl border border-gray-200">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                            <span class="text-2xl">💬</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#DCA278] mb-1">WhatsApp</h3>
                            <p class="text-gray-600">{{ $contact_info['whatsapp'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-6 bg-[#EBECCC] rounded-xl">
                    <h3 class="font-semibold text-[#DCA278] mb-3">Jam Operasional</h3>
                    <div class="space-y-2 text-gray-700">
                        <p>Senin - Jumat: <span class="font-medium">08.00 - 17.00 WIB</span></p>
                        <p>Sabtu: <span class="font-medium">08.00 - 14.00 WIB</span></p>
                        <p>Minggu: <span class="font-medium text-red-600">Tutup</span></p>
                    </div>
                </div>
            </div>

   
            <div class="bg-[#EBECCC] p-6 rounded-xl">
                <h2 class="text-xl font-bold text-gray-900 mb-8">Kirim Pesan</h2>
                
                <form class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-[#DCA278] mb-2">Nama Lengkap</label>
                        <input type="text" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#dca278] focus:border-transparent transition"
                               placeholder="Masukkan nama Anda">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#DCA278] mb-2">Email</label>
                        <input type="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#dca278] focus:border-transparent transition"
                               placeholder="nama@email.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#DCA278] mb-2">Nomor Telepon</label>
                        <input type="tel" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#dca278] focus:border-transparent transition"
                               placeholder="08xx-xxxx-xxxx">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#DCA278] mb-2">Pesan</label>
                        <textarea rows="5" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DCA278] focus:border-transparent transition resize-none"
                                  placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#DCA278] text-gray-800 py-4 rounded-lg font-medium hover:bg-[#FFF9E2] transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection