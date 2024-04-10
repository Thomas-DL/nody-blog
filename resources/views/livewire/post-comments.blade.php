<div class="pt-10 mt-10 border-t border-gray-100 dark:border-gray-700 comments-box">
    <h2 class="mb-5 text-2xl font-semibold text-gray-900">Discussions</h2>
    @auth
        <textarea wire:model="comment"
            class="w-full p-4 text-sm text-gray-700 dark:text-white border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 focus:outline-none placeholder:text-gray-400"
            cols="30" rows="7"></textarea>
        <button wire:click="postComment"
            class="inline-flex items-center justify-center h-10 px-4 mt-3 font-medium tracking-wide text-white transition duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-500 focus:shadow-outline focus:outline-none">
            Post Comment
        </button>
    @else
        <a wire:navigate class="py-1 text-indigo-600 underline" href="{{ route('login') }}"> Login to Post Comments</a>
    @endauth
    <div class="px-3 py-2 mt-5 user-comments">
        @forelse($this->comments as $comment)
            <div class="comment [&:not(:last-child)]:border-b border-gray-100 py-5">
                <div class="flex items-center mb-4 text-sm user-meta">
                    <img class="mr-3 rounded-full w-8 h-8" src="{{ $comment->user->getProfileAvatar() }}"
                        alt="{{ $comment->user->name }}">
                    <span class="mr-1 text-gray-500 dark:text-white">{{ $comment->user->name }} </span>
                    <span class="text-gray-500 dark:text-white">. {{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <div class="text-sm text-justify text-gray-700 dark:text-white">
                    {{ $comment->comment }}
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 dark:text-gray-400">
                <span> No Comments Posted</span>
            </div>
        @endforelse
    </div>
    <div class="my-2">
        {{ $this->comments->links() }}
    </div>
</div>
