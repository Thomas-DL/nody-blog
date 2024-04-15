<x-guest-layout>
    <div class="pt-16 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-900 p-4">
                        <div
                            class="flex items-center gap-y-8 sm:gap-y-0 justify-center sm:justify-start space-x-0 sm:space-x-8 flex-wrap">
                            <div>
                                <img src="{{ $author->getProfileAvatar() }}" alt="{{ $author->name }}"
                                    class="rounded-full w-32 h-32 mx-auto">
                            </div>
                            <div class="text-center sm:text-start">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                                    {{ '@' . $author->username }}
                                </h2>
                                <p class="text-gray-600 dark:text-gray-200">{{ $author->bio }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-900 py-6 sm:py-8">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">From
                                the blog</h2>
                            <p class="mt-2 text-lg leading-8 text-gray-600 dark:text-gray-200">Learn how to grow your
                                business with our
                                expert advice.</p>
                            <div
                                class="mt-10 space-y-16 border-t border-gray-200 dark:border-gray-700 pt-10 sm:mt-16 sm:pt-16">
                                @foreach ($posts as $post)
                                    <article class="flex max-w-xl flex-col items-start justify-between">
                                        <div class="flex items-center gap-x-4 text-xs">
                                            <time datetime="2020-03-16"
                                                class="text-gray-500 dark:text-gray-200">{{ $post->formatDate() }}</time>
                                            <span
                                                class="relative z-10 rounded-full bg-indigo-500/10 px-3 py-1 text-sm font-semibold leading-6 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">
                                                {{ $post->category->name }}
                                            </span>
                                        </div>
                                        <div class="group relative">
                                            <h3
                                                class="mt-3 text-lg font-semibold leading-6 text-gray-900 dark:text-white group-hover:text-gray-600">
                                                <a
                                                    href="{{ route('blog.show', [$post->category->slug, $post->slug]) }}">
                                                    <span class="absolute inset-0"></span>
                                                    {{ $post->title }}
                                                </a>
                                            </h3>
                                            <p
                                                class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600 dark:text-gray-200">
                                                {{ $post->excerpt }}
                                            </p>
                                        </div>
                                        <div class="relative mt-8 flex items-center gap-x-4">
                                            <img src="{{ $post->user->getProfileAvatar() }}" alt=""
                                                class="h-10 w-10 rounded-full bg-gray-50 dark:bg-gray-800">
                                            <div class="text-sm leading-6">
                                                <p class="font-semibold text-gray-900 dark:text-white">
                                                    <span class="absolute inset-0"></span>
                                                    {{ $post->user->name }}
                                                </p>
                                                <p class="text-gray-600 dark:text-gray-200">Co-Founder / CTO</p>
                                            </div>
                                        </div>
                                    </article>
                                    <hr class="my-4 dark:border-gray-700">
                                @endforeach

                                <div>
                                    {{ $posts->links() }}
                                </div>

                                <!-- More posts... -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
