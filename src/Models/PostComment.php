<?php

namespace Nody\NodyBlog\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{

  public $userModel;

  protected $fillable = [
    'user_id',
    'post_id',
    'comment',
  ];

  public function user()
  {
    $this->userModel = config('nody-blog.user_model');
    return $this->belongsTo($this->userModel);
  }

  public function post()
  {
    return $this->belongsTo(Post::class);
  }
}
