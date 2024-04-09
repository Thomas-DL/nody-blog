<?php

namespace Nody\NodyBlog\Http\Controllers;

class BlogController
{
    public function index()
    {
        return view('nody-blog::blog');
    }

    public function show($slug)
    {
        return view('nody-blog::post');
    }
}
