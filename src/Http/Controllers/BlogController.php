<?php

namespace Nody\NodyBlog\Http\Controllers;

class BlogController
{
  public function index()
  {
    return view('nody-blog::blog.index');
  }
}
