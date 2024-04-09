<div class="bg-white dark:bg-gray-900 pt-16">
    {{-- Post List Component --}}
    @if ($this->posts()->count() <= 0)
        <div class="pt-10">
            <div class="flex px-12 mb-10 justify-center max-w-lg lg:px-0 mx-4 sm:mx-auto">
                <div class="relative w-full mt-2">
                    <input type="text" name="search" id="search" placeholder="Search" wire:model.live="search"
                        class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="flex flex-col gap-y-4 p-4 justify-center items-center bg-gray-800 rounded-lg text-center">
                <x-heroicon-o-inbox class="w-12 h-12 text-white" />
                <p class="text-white text-xl">Empty posts</p>
            </div>
        </div>
    @else
        <div class="pt-10">
            <div class="flex justify-center px-12 max-w-lg lg:px-0 mx-auto">
                <div class="relative w-full mt-2">
                    <input type="text" name="search" id="search" placeholder="Search" wire:model.live="search"
                        class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <div
                    class="mx-auto px-12 mt-16 mx-4 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:px-0 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @foreach ($this->posts() as $post)
                        <article class="flex flex-col items-start">
                            <div class="relative w-full">
                                <img src="{{ $post->getThumbnail() }}" width="1200" height="630"
                                    class="w-full rounded-lg" alt="">
                                <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-300/10"></div>
                            </div>
                            <div class="max-w-xl">
                                <div class="mt-8 flex items-center gap-x-4 text-xs">
                                    <time datetime="2020-03-16"
                                        class="text-gray-900 dark:text-gray-100">{{ $post->formatDate() }}</time>
                                    <span href="#"
                                        class="relative z-10 rounded-full bg-indigo-500/10 px-3 py-1 text-sm font-semibold leading-6 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">{{ $post->category->name }}
                                    </span>
                                </div>
                                <div class="group relative">
                                    <h3
                                        class="mt-3 text-lg font-semibold leading-6 text-gray-900 dark:text-white group-hover:text-gray-200">
                                        <a href="{{ route('blog.show', [$post->category->slug, $post->slug]) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-900 dark:text-gray-100">
                                        {{ $post->excerpt }}
                                    </p>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
                @if ($this->showLoadMore && $this->showLoadMore === 'true')
                    <div class="mt-10 pb-10 flex justify-center">
                        <x-button type="button" color="primary" text="Load more" size="md"
                            wire:click="loadMore" />
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
