@if ($paginator->hasPages())
    {{-- 
      Container <nav> utama. 
      Kelas 'justify-between' dihapus, karena wrapper di index.blade.php 
      sudah mengurus 'justify-center'.
    --}}
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center">

        {{-- 1. TAMPILAN MOBILE (Tombol Previous & Next) --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                {{-- Tombol Previous (Disabled) --}}
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 border border-white/20 bg-white/5 backdrop-blur-sm cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                {{-- Tombol Previous (Link) --}}
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-200 border border-white/20 bg-white/10 backdrop-blur-sm leading-5 rounded-md hover:bg-white/20 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                {{-- Tombol Next (Link) --}}
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-200 border border-white/20 bg-white/10 backdrop-blur-sm leading-5 rounded-md hover:bg-white/20 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                {{-- Tombol Next (Disabled) --}}
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 border border-white/20 bg-white/5 backdrop-blur-sm cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- 2. TAMPILAN DESKTOP (Lengkap) --}}
        {{-- 
          Layout ini sudah benar (flex-col, items-center) 
          untuk menempatkan "Showing..." di atas tombol 1,2,3
        --}}
        <div class="hidden sm:flex-1 sm:flex sm:flex-col sm:items-center sm:space-y-4">
            
            {{-- Teks "Showing 1 to 10..." --}}
            <div>
                <p class="text-sm text-gray-300 leading-5"> {{-- Teks diubah jadi terang --}}
                    <span>{!! __('Showing') !!}</span>
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('to') !!}</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        <span class="font-medium">{{ $paginator->count() }}</span>
                    @endif
                    <span>{!! __('of') !!}</span>
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    <span>{!! __('results') !!}</span>
                </p>
            </div>

            {{-- Tombol "1, 2, 3..." --}}
            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                    
                    {{-- Tombol Panah Kiri (Previous) --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 border border-white/20 bg-white/5 backdrop-blur-sm cursor-default rounded-l-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-white border border-white/20 bg-white/10 backdrop-blur-sm rounded-l-md leading-5 hover:bg-white/20 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Elemen Angka --}}
                    @foreach ($elements as $element)
                        {{-- Tombol "..." (Dots) --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-300 border border-white/20 bg-white/10 backdrop-blur-sm cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Angka Halaman --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                {{-- Tombol Halaman AKTIF --}}
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        {{-- Style ini dibuat agar sama dengan <x-glass-button bg="bg-white"> --}}
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-bold text-dark-purple border border-white/20 bg-white backdrop-blur-sm cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    {{-- Tombol Halaman Lain (Link) --}}
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white border border-white/20 bg-white/10 backdrop-blur-sm leading-5 hover:bg-white/20 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Tombol Panah Kanan (Next) --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-white border border-white/20 bg-white/10 backdrop-blur-sm rounded-r-md leading-5 hover:bg-white/20 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 border border-white/20 bg-white/5 backdrop-blur-sm cursor-default rounded-r-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif