<x-guest-layout>
    <div class="relative px-6 py-32 lg:px-8 bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">
            @auth
                <div class="flex justify-end">
                    <a href="{{ route('filament.admin.resources.posts.edit', $post->id) }}">
                        Éditer l'article
                    </a>
                </div>
            @endauth
            <p class="text-base font-semibold leading-7 text-indigo-600">{{ $post->category->name }}</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                {{ $post->title }}</h1>
            <p class="mt-6 text-xl leading-8 text-gray-900 dark:text-white">{{ $post->excerpt }}</p>
            <figure class="mt-16">
                <img class="aspect-video rounded-xl bg-gray-50 object-cover" src="{{ $post->getThumbnail() }}"
                    alt="">
            </figure>
            <div class="mt-10 max-w-2xl post-content text-gray-900 dark:text-white">
                {!! $post->content !!}
            </div>
            <hr class="my-12">
            <div class="flex justify-between">
                <div class="flex gap-x-4">
                    <span>1</span>
                    <x-heroicon-o-heart class="w-6 h-6 text-gray-600 dark:text-gray-100" />
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
