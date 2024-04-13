<?php

namespace Nody\NodyBlog\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Nody\NodyBlog\Models\Tag;
use Nody\NodyBlog\Models\Post;
use Livewire\Attributes\Computed;
use Nody\NodyBlog\Models\Category;

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
     * All categories.
     *
     * @var Collection
     *
     * @param Collection $categories
     */

    public $categories; // Collection

    /**
     * The selected category.
     *
     * @var int
     *
     * @param int $selectedCategory
     */

    public $selectedCategory; // Integer

    /**
     * The selected category name.
     *
     * @var string
     *
     * @param string $selectedCategoryName
     */

    public $selectedCategoryName; // String

    /**
     * All tags.
     *
     * @var Collection
     *
     * @param Collection $tags
     */

    public $tags; // Collection

    /**
     * The selected tags.
     *
     * @var array
     *
     * @param array $selectedTags
     */

    public $selectedTags; // Array

    /**
     * The selected tags name.
     *
     * @var array
     *
     * @param array $selectedTagsName
     */

    public $selectedTagsName; // Array

    /**
     * The selected tags option.
     *
     * @var string
     *
     * @param string $selectedSort
     */

    public $selectedSort; // String

    /**
     * Show load more button
     *
     * @var bool
     *
     * @param  bool  $showLoadMore
     */

    /**
     * Name of active filters
     *
     * @var array
     *
     * @param array $activeFilter
     */

    public $activeFilter; // Array

    public $showLoadMore; // Boolean

    /**
     * Show searchbar
     *
     * @var bool
     *
     * @param bool $showSearch
     */

    public function __construct()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->selectedCategory = null;
        $this->selectedCategoryName = '';
        $this->selectedTags = [];
        $this->selectedTagsName = [];
    }

    public $showSearch; // Boolean

    public function loadMore()
    {
        $this->postsCount += 3;
    }

    public function clearFilters()
    {
        return redirect()->to(route('blog.index'));
    }

    #[On('selectedSort')]
    public function sortBy($request)
    {
        switch ($request) {
            case 'newest':
                $this->selectedSort = $request;
                break;
            case 'best-rating':
                $this->selectedSort = $request;
                break;
            default:
        }
    }

    #[On('selectedCategory')]
    public function filterByCategory($request)
    {
        $this->selectedCategory = $request;
        $this->selectedCategoryName = Category::find($request)->name;
    }

    #[On('selectedTags')]
    public function filterByTags($request)
    {
        if (in_array($request, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$request]);
            $this->selectedTagsName = array_diff($this->selectedTagsName, [Tag::find($request)->name]);
            return;
        } else {
            $this->selectedTags[] = $request;
            $this->selectedTagsName[] = Tag::find($request)->name;
        }
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

        $query = Post::published();

        // Filtrer par catégorie
        if ($this->selectedCategory) {
            $query->ByCategory($this->selectedCategory)->take($this->postsCount)->get();
        }

        // Filtrer par tags
        if (!empty($this->selectedTags)) {
            $query->ByTags($this->selectedTags)->take($this->postsCount)->get();
        }

        // Trier les résultats
        if ($this->selectedSort == 'newest') {
            $query->latest()->take($this->postsCount)->get();
        } elseif ($this->selectedSort == 'best-rating') {
            $query->BestRating()->take($this->postsCount)->get();
        }

        if (!empty($this->search)) {
            return $query->where(function ($args) {
                $args->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%")
                    ->orWhere('excerpt', 'like', "%{$this->search}%");
            })
                ->latest()
                ->take($this->postsCount)
                ->get();
        } else {
            return $query->latest()->take($this->postsCount)->get();
        }

        return $query->get();
    }

    public function render()
    {
        return view('nody-blog::livewire.get-posts');
    }
}
