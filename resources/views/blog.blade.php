<x-guest-layout>
    <div class="bg-white dark:bg-gray-900 pt-16 h-full">
        <livewire:get-posts postsCount="{{ config('nody-blog.posts_per_page') }}"
            showLoadMore="{{ config('nody-blog.load_more') }}" showSearch="{{ config('nody-blog.searchbar') }}" />
    </div>
</x-guest-layout>
