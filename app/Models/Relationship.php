<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
}
