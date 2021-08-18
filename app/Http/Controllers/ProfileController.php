<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Relationship;
use App\Http\Requests\EditProfileRule;
use App\Http\Requests\EditPassRule;

class ProfileController extends Controller
{

	public function __construct(User $user, Relationship $relationship)
	{
		$this->user = $user;
		$this->relationship = $relationship;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	public function detail($id)
	{
		$user = $this->user->getDetailById($id);
		$family_insurances = $user->family_insurances->sortBy('relationship');
		$is_following = $this->relationship->canUnfollow($id);
		$is_followed = $this->relationship->isFollowed($id);
		$user->posts = Post::where('user_id', $user->id)->orderBy('id', 'DESC')->take(3)->get();
		$user->comments = Comment::where('user_id', $user->id)->orderBy('id', 'DESC')->take(3)->get();
		return view('profile.detail', compact('user', 'family_insurances', 'is_following', 'is_followed', 'posts', 'comments'));
	}

	public function adminOnlyDetail($id)
	{
		$user = $this->user->getDetailById($id);
		$family_insurances = $user->family_insurances->sortBy('relationship');
		return view('profile.admin_detail', compact('user', 'family_insurances'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if ($id != Auth::id()) {
			return redirect(route('profile', [Auth::id()]))->with('error', '不正な処理が検出されました');
		}
		$user = $this->user->getDetailById($id);
		return view('profile.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(EditProfileRule $request)
	{
		if ($request->id != Auth::id()) {
			return redirect(route('profile', [Auth::id()]))->with('error', '不正な処理が検出されました');
		}
		$this->user->updateProfile($request);
		return redirect(route('profile', [Auth::id()]))->with('success', 'プロフィールを編集しました');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function edit_pass($id)
	{
		if ($id != Auth::id()) {
			return redirect(route('profile', [Auth::id()]))->with('error', '不正な処理が検出されました');
		}
		$user = $this->user->getDetailById($id);
		return view('profile.edit_pass', compact('user'));
	}

	public function update_pass(EditPassRule $request)
	{
		if ($request->id != Auth::id()) {
			return redirect(route('profile', [Auth::id()]))->with('error', '不正な処理が検出されました');
		}
		$this->user->updatePass($request);
		return redirect(route('profile', [Auth::id()]))->with('success', 'パスワードを変更しました');
	}

	public function image_delete($id)
	{
		$user = $this->user->getDetailById($id);
		if ($id != Auth::id() || !$user->image_pass) {
			return redirect(route('profile', [Auth::id()]))->with('error', '不正な処理が検出されました');
		}
		$user->deleteImage($user);
		return redirect(route('profile.edit', [Auth::id()]))->with('success', '画像を消去しました');
	}
}
