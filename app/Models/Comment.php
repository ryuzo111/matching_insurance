<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function saveComment($data)
    {
        $this->comment = $data->comment;
        $this->post_id = $data->post_id;
        $this->user_id = Auth::id();
        $this->save();
        return true;
    }
}
