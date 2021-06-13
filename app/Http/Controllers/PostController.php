<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRule;
use App\Http\Requests\EditPostRule;
use App\Models\InterestedInsurance;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(Post $post, InterestedInsurance $interested_insurance)
    {
        $this->post = $post;
        $this->interested_insurance = $interested_insurance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->getPaginatedPosts();
        return view('post/index', compact('posts'));
    }

    /**
     * Display a listing of the result of search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //検索がセットされていない場合
        if (is_null($request->word)) {
            $posts = $this->post->getPaginatedPosts();
        } else {
            $posts = $this->post->getPaginatedSearchResults($request->word);
        }
        // return view('post/index', compact('posts', 'request'));

        return view('post/search', compact('posts', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRule $request)
    {
        $this->post->createPost($request);
        return redirect()->route('post.index')->with('success', '投稿しました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //user_idとログインidが同一でない場合
        if ($post->user_id != Auth::id()) {
            return redirect()->route('post.index')->with('error', '編集することができません。');
        }
        $target_post = $this->post->getDetailPostById($post->id);
        $insurance = $this->interested_insurance->getInterestedInsuranceByPostId($post->id);
        //初期値を編集フォームで入れるためには無理矢理配列を渡す必要がある
        $arr = $insurance->toArray();
        $insurance_arr = array_splice($arr, 2, 8);
        foreach ($insurance_arr as $insurance_key => $insurance_value) {
            if ($insurance_value === 1) {
                $interested_insurance_arr[] = $insurance_key;
            }
        }
        return view('post.edit', compact('target_post', 'interested_insurance_arr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRule $request, Post $post)
    {
        //user_idとログインidが同一でない場合
        if ($post->user_id != Auth::id()) {
            return redirect()->route('post.index')->with('error', '編集することができません。');
        }
        $this->post->editPost($request, $post);
        // return view('post/detail', compact('post'));
        return redirect()->route('post.index')->with('success', '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        //user_idとログインidが同一でない場合
        if ($post->user_id != Auth::id()) {
            return redirect()->route('post.index')->with('error', '編集することができません。');
        }
        $this->post->deletePostById($post->id);
        return redirect()->route('post.index')->with('success', '削除しました');
    }

    public function detail(Request $request)
    {
        $post = $this->post->getDetailPostById($request->input('post_id'));
        return view('post/detail', compact('post'));
    }
}
