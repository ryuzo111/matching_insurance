<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Good extends Model
{
    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }

    public function saveGoodByCommentId($comment_id)
    {
        $this->comment_id = $comment_id;
        $this->user_id = Auth::id();
        $this->save();
        return true;
    }

    public function deleteGoodByCommentId($comment_id)
    {
        if ($this->where('comment_id', $comment_id)->where('user_id', Auth::id())->exists()) {
            $this->where('comment_id', $comment_id)->where('user_id', Auth::id())->delete();
            return true;
        } else {
            return false;
        }
    }
}
