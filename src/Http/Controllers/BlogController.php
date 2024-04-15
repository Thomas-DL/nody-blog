<?php

namespace Nody\NodyBlog\Http\Controllers;

use App\Models\User;
use Nody\NodyBlog\Models\Post;

class BlogController
{
    public function index()
    {
        return view('nody-blog::blog');
    }

    public function show($categorySlug, $postSlug)
    {
        $post = Post::Published()->where('slug', $postSlug)->firstOrFail();

        return view('nody-blog::post', compact('post'));
    }

    public function author($userId)
    {
        $posts = Post::Published()->where('user_id', $userId)->latest()->paginate(10);
        $author = User::findOrFail($userId);

        return view('nody-blog::author', compact('posts', 'author'));
    }
}
