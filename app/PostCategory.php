<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    //
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    // Find the Category of the Post
    public function postCategory()
    {
        $postCategory = Post::find($this->post_category_id);
        return $postCategory;
    }

    protected $table = 'posts_categories';
}