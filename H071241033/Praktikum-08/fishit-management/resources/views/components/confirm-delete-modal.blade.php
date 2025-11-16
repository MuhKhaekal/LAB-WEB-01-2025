@props(['actionUrl'])

<div x-data="{ open: false }">
    <div @click="open = true">
        {{ $slot }}
    </div>

    <template x-teleport='body'>
        <div x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click.self="open = false"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-md p-4"
            style="display: none;">
                
            <div class="w-full max-w-md rounded-xl backdrop-blur-sm border border-white/20 bg-white/10 p-6 shadow-xl"
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90">
                
                <h3 class="text-lg font-bold text-white">Are you sure?</h3>
                <p class="mt-2 text-sm text-gray-300">
                    This action cannot be undone. This will permanently delete the fish data.
                </p>
                
                <form method="POST" action="{{ $actionUrl }}" class="mt-6 flex justify-end gap-4">
                    @csrf
                    @method('DELETE')

                    <x-glass-button type="button" @click="open = false">
                        Cancel
                    </x-glass-button>

                    <x-glass-button type="submit" bg="bg-red-600/80" textColor="text-white">
                        Confirm Delete
                    </x-glass-button>
                </form>
            </div>
        </div>
    </template>
</div>