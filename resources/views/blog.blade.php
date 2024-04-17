<x-guest-layout>
    <div class="bg-white dark:bg-gray-900 pt-16 h-full">
        <div class="bg-white dark:bg-gray-900 px-6 py-24 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-base font-semibold leading-7 text-indigo-600 dark:text-indigo-500">
                    {{ __('nody-blog::blog.blog_subtitle') }}
                </p>
                <h2 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl">
                    {{ __('nody-blog::blog.blog_title') }}
                </h2>
                <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-400">
                    {{ __('nody-blog::blog.blog_description') }}
                </p>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-900">
            <div class="container mx-auto">
                <livewire:get-posts postsCount="{{ config('nody-blog.posts_per_page') }}"
                    showLoadMore="{{ config('nody-blog.load_more') }}" showSearch="{{ config('nody-blog.searchbar') }}"
                    showFilters="1" />
            </div>
        </div>
    </div>
</x-guest-layout>
