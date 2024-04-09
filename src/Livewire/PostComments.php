<?php

namespace Nody\NodyBlog\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Nody\NodyBlog\Models\Post;

class PostComments extends Component
{
  use WithPagination;

  public Post $post;

  #[Rule('required|min:3|max:200')]
  public string $comment;

  public function postComment()
  {
    if (auth()->guest()) {
      return;
    }

    $this->validateOnly('comment');

    $this->post->comments()->create([
      'comment' => $this->comment,
      'user_id' => auth()->id(),
    ]);

    $this->reset('comment');
  }

  #[Computed()]
  public function comments()
  {
    return $this?->post?->comments()->with('user')->latest()->paginate(5);
  }

  public function render()
  {
    return view('nody-blog::livewire.post-comments');
  }
}
