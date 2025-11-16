<div class="group bg-[#CDD4B1] rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
    <div class="overflow-hidden">
        <img src="{{ asset('images/' . $image) }}" 
             alt="{{ $title }}" 
             class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
    </div>
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $title }}</h3>
        <p class="text-gray-600 leading-relaxed">{{ $description }}</p>
    </div>
</div>