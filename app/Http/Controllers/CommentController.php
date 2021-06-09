<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Good;
use App\Http\Requests\SaveCommentRule;
use App\Http\Requests\EditCommentRule;
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

    public function comment(SaveCommentRule $request)
    {
        $comment_id = $this->comment->saveComment($request);
        $comment_data = $this->comment->getCommentById($comment_id);
        Mail::send(new CommentNotification($comment_data));
        session()->flash('flash_message', 'コメントを投稿しました');
        return redirect()->route('post.detail', ['post_id' => $request->input('post_id')]);
    }

    public function delete(Request $request)
    {
        $comment = $this->comment->getCommentById($request->input('comment_id'));
        $this->comment->deleteCommentById($request->input('comment_id'));
        session()->flash('flash_message', 'コメントを削除しました');
        return redirect()->route('post.detail', ['post_id' => $comment->post_id]);
    }

    public function editForm(Request $request)
    {
        $target_comment = $this->comment->getCommentById($request->input('comment_id'));
        $post = $this->post->getDetailPostById($target_comment->post_id);
        return view('post/comment_edit', compact('post', 'target_comment'));
    }

    public function edit(EditCommentRule $request)
    {
        $this->comment->editComment($request);
        session()->flash('flash_message', 'コメントを編集しました');
        return $this->redirectDetailByCommentId($request->input('comment_id'));
    }

    public function good(Request $request)
    {
        $this->good->saveGoodByCommentId($request->input('comment_id'));
        session()->flash('flash_message', 'コメントにいいねしました');
        return $this->redirectDetailByCommentId($request->input('comment_id'));
    }

    public function deleteGood(Request $request)
    {
        $this->good->deleteGoodByCommentId($request->input('comment_id'));
        session()->flash('flash_message', 'コメントのいいねを取り消しました');
        return $this->redirectDetailByCommentId($request->input('comment_id'));
    }

    public function redirectDetailByCommentId($comment_id)
    {
        $comment = $this->comment->getCommentById($comment_id);
        return redirect()->route('post.detail', ['post_id' => $comment->post_id]);
    }
}
