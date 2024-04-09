<x-guest-layout>
    <div class="px-6 py-32 lg:px-8">
        <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">
            @auth
                <div class="flex justify-end">
                    <a href="{{ route('filament.admin.resources.posts.edit', $post->id) }}">
                        Éditer l'article
                    </a>
                </div>
            @endauth
            <p class="text-base font-semibold leading-7 text-indigo-600">{{ $post->category->name }}</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ $post->title }}</h1>
            <p class="mt-6 text-xl leading-8 text-white">{{ $post->excerpt }}</p>
            <figure class="mt-16">
                <img class="aspect-video rounded-xl bg-gray-50 object-cover" src="{{ $post->getThumbnail() }}"
                    alt="">
            </figure>
            <div class="mt-10 max-w-2xl post-content text-white">
                {!! $post->content !!}
            </div>
        </div>
    </div>

    <livewire:featured-post :category="$post->category->id" :currentPost="$post->id" />
</x-guest-layout>
