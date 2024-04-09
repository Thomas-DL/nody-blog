<x-guest-layout>

    <livewire:get-posts postsCount="{{ config('nody-blog.post_per_page') }}"
        showLoadMore="{{ config('nody-blog.load_more') }}" />

</x-guest-layout>
