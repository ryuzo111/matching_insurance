<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Good;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentEditRequest;
use Mail;
use App\Mail\CommentNotification;

class CommentController extends Controller
{
    public function __construct(Comment $comment, Post $post, Good $good)
    {
        $this->comment = $comment;
        $this->post = $post;
        $this->good = $good;
    }

    public function comment(CommentRequest $request)
    {
        $comment_id = $this->comment->saveComment($request);
        $comment_data = $this->comment->getCommentData($comment_id);
        Mail::send(new CommentNotification($comment_data));
        return redirect()->route('post.detail', ['post_id' => $request->input('post_id')]);
    }

    public function delete(Request $request)
    {
        $this->comment->deleteComment($request->input('comment_id'));
        $comment_data = $this->comment->getCommentData($request->input('comment_id'));
        return redirect()->route('post.detail', ['post_id' => $comment_data->post_id]);
    }

    public function editForm(Request $request)
    {
        $comment_data = $this->comment->getCommentData($request->input('comment_id'));
        $post = $this->post->getDetailPost($comment_data->post_id);
        return view('post/comment_edit', compact('post', 'comment_data'));
    }

    public function edit(CommentEditRequest $request)
    {
        $this->comment->editComment($request);
        return $this->redirectDetail($request->input('comment_id'));
    }

    public function good(Request $request)
    {
        $this->good->saveGood($request->input('comment_id'));
        return $this->redirectDetail($request->input('comment_id'));
    }
    public function deleteGood(Request $request)
    {
        $this->good->deleteGood($request->input('comment_id'));
        return $this->redirectDetail($request->input('comment_id'));
    }

    public function redirectDetail($comment_id)
    {
        $comment_data = $this->comment->getCommentData($comment_id);
        return redirect()->route('post.detail', ['post_id' => $comment_data->post_id]);
    }
}
