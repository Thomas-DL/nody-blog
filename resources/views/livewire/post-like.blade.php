<div class="flex gap-x-4">
    <button wire.loading.attr="disabled" wire:click="toggleLike" class="flex items-center">

        <x-heroicon-s-heart wire:loading.delay.remove
            class="w-6 h-6 {{ Auth::user()?->hasLiked($post) ? 'text-red-600' : 'text-gray-400' }}  hover:text-red-400" />
        <span class="ml-2 text-gray-600">
            {{ $post->likes()->count() }}
        </span>
    </button>
</div>
