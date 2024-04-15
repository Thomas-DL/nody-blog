@php
    // dd($post->tags);
    $meta = [
        'title' => $post->title,
        'description' => $post->excerpt,
        'author' => $post->user->name,
        'image' => $post->getThumbnail(),
        'keywords' =>
            'blog, post, article, ' .
            $post->category->name .
            ', ' .
            implode(
                ', ',
                optional($post->tags)
                    ->pluck('name')
                    ->toArray(),
            ),
        'url' => URL::current(),
    ];
@endphp
<x-guest-layout :data="$meta">
    <div class="relative px-6 py-32 lg:px-8 bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">
            <div class="mb-10 flex items-center justify-between gap-x-2 text-gray-900 dark:text-gray-100">
                <div class="flex items-center gap-x-2 hover:text-indigo-600 transition">
                    <x-heroicon-o-arrow-left class="w-4 h-4" />
                    <a href="{{ route('blog.index') }}" alt="Backlink for return on posts list page"
                        title="Back to posts list">Back to posts list</a>
                </div>
                @auth
                    <div class="flex items-center gap-x-2 hover:text-indigo-600 transition">
                        <x-heroicon-o-pencil class="w-4 h-4" />
                        <a href="{{ route('filament.admin.resources.posts.edit', $post->id) }}">
                            Éditer l'article
                        </a>
                    </div>
                @endauth
            </div>
            <div id="post-content">
                <p class="text-base font-semibold leading-7 text-indigo-600">{{ $post->category->name }}</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    {{ $post->title }}</h1>
                <div class="flex justify-between">
                    <div class="flex items-center mt-4 gap-x-2 text-gray-600 dark:text-gray-400">
                        <x-heroicon-o-calendar class="w-6 h-6" />
                        Updated {{ $post->updated_at->diffForHumans() }}
                    </div>
                    <div class="flex items-center mt-4 gap-x-2 text-gray-600 dark:text-gray-400">
                        <x-heroicon-o-clock class="w-6 h-6" />
                        <span>{{ $post->getReadingTime() }}
                            min read</span>
                    </div>
                </div>
                <hr class="my-4 dark:border-gray-700">
                <p class="mt-6 text-xl leading-8 text-gray-900 dark:text-white">{{ $post->excerpt }}</p>
                <figure class="mt-16">
                    <img class="aspect-video rounded-xl bg-gray-50 object-cover" src="{{ $post->getThumbnail() }}"
                        alt="Thumbnail for illustrate this article: {{ $post->title }}">
                </figure>
                <div class="mt-10 max-w-2xl post-content text-gray-900 dark:text-white">
                    {!! $post->content !!}
                </div>
            </div>
            <hr class="my-12 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="relative flex items-center gap-x-4">
                    <img src="{{ $post->user->getProfileAvatar() }}" alt=""
                        class="h-10 w-10 rounded-full bg-gray-100">
                    <div class="text-sm leading-6">
                        <p class="font-semibold text-gray-900 dark:text-white">
                            <a href="{{ route('blog.author', $post->user->id) }}">
                                <span class="absolute inset-0"></span>
                                {{ $post->user->name }}
                            </a>
                        </p>
                        <p class="text-gray-600 dark:text-gray-400">Co-Founder / CTO</p>
                    </div>
                </div>
                <div class="flex gap-x-4 items-center">
                    <div class="flex gap-x-4">
                        <livewire:post-like :key="'like-' . $post->id" :$post />
                    </div>
                    <div class="relative inline-block text-left" x-data="{ open: false }">
                        <div class="flex items-center">
                            <button type="button" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                <x-heroicon-o-share class="w-5 h-5 text-gray-900 dark:text-gray-400"
                                    @click="open = !open" />
                            </button>
                        </div>
                        <div x-show="open" x-transition @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <span x-data="copyHandler()" x-on:click="copyUrl"
                                    class="text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 group flex items-center px-4 py-2 text-sm cursor-pointer"
                                    role="menuitem" tabindex="-1" id="menu-item-0">
                                    <x-heroicon-o-link class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" />
                                    Copy link
                                </span>
                            </div>
                            <div class="py-1" role="none">
                                <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{ htmlentities(URL::current()) }}"
                                    class="text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 group flex items-center px-4 py-2 text-sm"
                                    role="menuitem" tabindex="-1" id="menu-item-2">
                                    <x-fab-linkedin-in class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" />
                                    Share on LinkedIn
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ $post->title }}&url={{ URL::current() }}"
                                    class="text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 group flex items-center px-4 py-2 text-sm"
                                    role="menuitem" tabindex="-1" id="menu-item-3">
                                    <x-fab-x-twitter class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" />
                                    Share on Twitter
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}&quote={{ $post->title }}"
                                    class="text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 group flex items-center px-4 py-2 text-sm"
                                    role="menuitem" tabindex="-1" id="menu-item-3">
                                    <x-fab-facebook-f class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-500" />
                                    Share on Facebook
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mt-12">
                <livewire:post-comments :key="'comments' . $post->id" :$post />
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('copyHandler', () => ({
                copyUrl() {
                    navigator.clipboard.writeText(window.location.href)
                        .then(() => alert('URL copiée dans le presse-papiers!'))
                        .catch(err => console.error('Erreur lors de la copie :', err));
                }
            }));
        });
    </script>

</x-guest-layout>
