<div>
    <h1>Get Posts</h1>
    <button wire:click="getPosts">Get Posts</button>
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post['title'] }}</li>
        @endforeach
    </ul>
</div>
