<?php

namespace Nody\NodyBlog\Livewire;

use Livewire\Component;
use Nody\NodyBlog\Models\Post;

class PostLike extends Component
{

  public Post $post;


  public function toggleLike()
  {
    if (auth()->guest()) {
      return $this->redirect(route('login'), true);
    }

    $user = auth()->User::class;

    if ($user->hasLiked($this->post)) {
      $user->likes()->detach($this->post);
      return;
    }

    $user->likes()->attach($this->post);
  }

  public function render()
  {
    return view('nody-blog::livewire.post-like');
  }
}
