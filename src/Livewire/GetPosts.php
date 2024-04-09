<?php

namespace Nody\NodyBlog\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Nody\NodyBlog\Models\Post;

class GetPosts extends Component
{
    /**
     * The number of posts to display.
     *
     * @var int
     *
     * @param  int  $postsCount
     */
    public $postsCount; // Integer

    /**
     * The posts to display.
     *
     * @var mixed
     *
     * @param  mixed  $categories
     */
    public $categories; // Array

    /**
     * The posts to display.
     *
     * @var mixed
     *
     * @param  mixed  $tags
     */
    public $tags; // Array

    /**
     * Show load more button
     *
     * @var bool
     *
     * @param  bool  $showLoadMore
     */
    public $showLoadMore; // Boolean

    #[Computed()]
    public function posts()
    {
        return Post::published()->latest()->take($this->postsCount)->get();
    }

    public function render()
    {
        return view('nody-blog::livewire.get-posts');
    }
}
