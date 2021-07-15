<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relationship;
use App\Models\User;

class RelationshipController extends Controller
{
	public function __construct(Relationship $relationship, User $user)
	{
		$this->relationship = $relationship;
		$this->user = $user;
	}

	public function following(Request $request)
	{
		$following_user_id = $request->input('following_user_id');
		$user = $this->user->getDetailById($following_user_id);
		$followees = $this->relationship->getFollowingUsersById($following_user_id);
		return view('relationship.following', compact('followees', 'following_user_id'));
	}

	public function followers(Request $request)
	{
		$followed_user_id = $request->input('followed_user_id');
		$user = $this->user->getDetailById($followed_user_id);
		$followers = $this->relationship->getFollowedUsersById($followed_user_id);
		return view('relationship.followers', compact('followers', 'followed_user_id'));
	}

	public function follow(Request $request)
	{
		$can_follow = $this->relationship->canFollow($request->input('followed_id'));

		if ($can_follow == false) {
			return back()->with('error', 'フォローできません');
		}

		$this->relationship->saveFollowByFollowedId($request->input('followed_id'));
		return back()->with('success', 'フォローしました');
	}

	public function unfollow(Request $request)
	{
		$can_unfollow = $this->relationship->canUnfollow($request->input('followed_id'));

		if ($can_unfollow == false) {
			return back()->with('error', 'エラーが発生しました');
		}

		$this->relationship->unfollowByFollowedId($request->input('followed_id'));
		return back()->with('success', 'フォロー解除しました');
	}

}
