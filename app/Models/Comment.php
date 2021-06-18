<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function goods()
    {
        return $this->hasMany('App\Models\Good', 'comment_id', 'id');
    }

    public function saveComment($data)
    {
        $this->comment = $data->comment;
        $this->post_id = $data->post_id;
        $this->user_id = Auth::id();
        $this->save();
        return $this->id;
    }

    public function deleteCommentById($comment_id)
    {
        $this->findOrFail($comment_id)->delete();
        return true;
    }

    public function getCommentById($comment_id)
    {
        $comment = $this->findOrFail($comment_id);
        return $comment;
    }
    public function editComment($comment)
    {
        $target_comment = $this->getCommentById($comment->comment_id);
        $target_comment->comment = $comment->comment;
        $target_comment->save();
        return true;
    }

    public function getWeeklyGoodComments()
    {
		$sevendays_ago = Carbon::today()->subDay(7);
		$comments = $this->whereDate('created_at', '>=', $sevendays_ago)
			->withCount('goods')
			->orderBy('goods_count', 'desc')->get();
		$comments = $comments->whereNotIn('goods_count', 0);
		return $comments;
    }

}
