<?php

namespace Nody\NodyBlog\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Nody\NodyBlog\Models\Post;
use Livewire\Attributes\Computed;

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
     * The search query.
     *
     * @var string
     *
     * @param  string  $search
     */

    public $search; // String

    /**
     * Show load more button
     *
     * @var bool
     *
     * @param  bool  $showLoadMore
     */
    public $showLoadMore; // Boolean

    public function loadMore()
    {
        $this->postsCount += 3;
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    #[Computed()]
    public function posts()
    {
        if (!empty($this->search)) {
            return Post::published()->where(function ($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%")
                    ->orWhere('excerpt', 'like', "%{$this->search}%");
            })
                ->latest()
                ->take($this->postsCount)
                ->get();
        } else {
            return Post::published()->latest()->take($this->postsCount)->get();
        }
    }

    public function render()
    {
        return view('nody-blog::livewire.get-posts');
    }
}
