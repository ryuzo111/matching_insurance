<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    
    public function comment(CommentRequest $request)
    {
        $this->comment->saveComment($request);
        return redirect()->route('post.detail',['post_id' => $request->input('post_id')]);
    }

}
