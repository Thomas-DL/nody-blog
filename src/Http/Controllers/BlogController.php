<?php

namespace Nody\NodyBlog\Http\Controllers;

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

        return view('nody-blog::author');
    }
}
