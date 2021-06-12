<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function interested_insurance()
    {
        return $this->hasOne('App\Models\InterestedInsurance');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function getPaginatedPosts()
    {
        return $this->paginate(10);
    }

    public function getPaginatedSearchResults($word)
    {
        $posts = $this->where('title', 'like', '%' . $word . '%')->paginate(10);
        return $posts;
    }

    public function getDetailPostById($post_id)
    {
        $post = Post::findOrFail($post_id);
        return $post;
    }
}
