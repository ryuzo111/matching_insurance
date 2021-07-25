<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Post;
use App\Models\Comment;

class Relationship extends Model
{
	protected $guarded = ['id'];
	public $timestamps = false;

	public function following_user()
	{
		return $this->hasOne('App\Models\User', 'id', 'follower_id');
	}

	public function followed_user()
	{
		return $this->hasOne('App\Models\User', 'id', 'followed_id');
	}

	public function getFollowingUsersById($follower_id)
	{
		$following_users = $this->where('follower_id', $follower_id)->get();
		return $following_users;
	}

	public function getFollowedUsersById($followed_id)
	{
		$followed_users = $this->where('followed_id', $followed_id)->get();
		return $followed_users;
	}

	public function saveFollowByFollowedId($followed_id)
	{
		$relationship = $this->create([
			'follower_id' => Auth::id(),
			'followed_id' => $followed_id,
		]);

		return true;
	}

	public function unfollowByFollowedId($followed_id)
	{
		$this->where('follower_id', Auth::id())->where('followed_id', $followed_id)->delete();
		return true;
	}

	public function canFollow($followed_id)
	{
		$can_follow = true;

		if ($followed_id == Auth::id() || !(ctype_digit($followed_id))) {
			$can_follow = false;
		}
		if (User::where('id', $followed_id)->exists() == false) {
			$can_follow = false;
		}
		if ($this->where('follower_id', Auth::id())->where('followed_id', $followed_id)->exists()) {
			$can_follow = false;
		}

		return $can_follow;
	}

	//フォロー解除できる状態＝フォローしている状態なので、フォローしているかも判定
	public function canUnfollow($followed_id)
	{
		$can_unfollow = true;

		if ($this->where('follower_id', Auth::id())->where('followed_id', $followed_id)->exists() == false) {
			$can_unfollow = false;
		}

		return $can_unfollow;
	}

	//フォローされているか
	public function isFollowed($follower_id)
	{
		$is_followed = $this->where('follower_id', $follower_id)->where('followed_id', Auth::id())->exists();
		return $is_followed;
	}

	public function getFollowedUsersPostsAndComments($request)
	{
		$followed = $this->where('follower_id', Auth::id())->get();
		$posts = Post::whereIn('user_id', $followed->pluck('followed_id'))->get();
		$comments = Comment::whereIn('user_id', $followed->pluck('followed_id'))->get();
		$posts_and_comments = $posts->merge($comments)->sortByDesc('created_at');
		$posts_and_comments = new LengthAwarePaginator(
			$posts_and_comments->forPage($request->page, 10),
			$posts_and_comments->count(),
			10,
			$request->page,
			[
				'path' => $request->url()
			]
		);
		return $posts_and_comments;
	}
}
