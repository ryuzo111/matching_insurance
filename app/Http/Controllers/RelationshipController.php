<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relationship;

class RelationshipController extends Controller
{
	public function __construct(Relationship $relationship)
	{
		$this->relationship = $relationship;
	}

	public function following(Request $request)
	{
		$followees = $this->relationship->getFollowingUsersById($request->input('following_user_id'));
		return view('relationship.following', compact('followees'));
	}

	public function followers(Request $request)
	{
		$followers = $this->relationship->getFollowedUsersById($request->input('followed_user_id'));
		return view('relationship.followers', compact('followers'));
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
