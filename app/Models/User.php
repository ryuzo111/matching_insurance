<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class User extends Authenticatable
{
	use Notifiable;

	/*
	protected $fillable = [
		'name', 'email', 'password',
	];
	 */
	protected $guarded = [
		'id'
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function posts()
	{
		return $this->hasMany('App\Models\Post');
	}

	public function family_insurances()
	{
		return $this->hasMany('App\Models\FamilyInsurance');
	}

	public function comments()
	{
		return $this->hasMany('App\Models\Comment', 'user_id');
	}

	//フォローしている人
	public function followers()
	{
		return $this->hasMany('App\Models\Relationship', 'follower_id');
	}

	//フォローされている人
	public function followees()
	{
		return $this->hasMany('App\Models\Relationship', 'followed_id');
	}

	public function getDetailById($id)
	{
		$user = $this->where('id', $id)->firstOrFail();
		return $user;
	}

	public function deleteImage($user)
	{
		File::delete('storage/image/' . $user->image_pass);
		$user->image_pass = null;
		$user->save();
		return true;
	}

	public function updateProfile($data)
	{
		$user = $this->getDetailById(Auth::id());

		if ($data->image) {
			if ($user->image_pass) {
				File::delete('storage/image/' . $user->image_pass);
			}
			$image = uniqid() . '.' . $data->image->getClientOriginalExtension();
			$data->image->storeAs('public/image', $image);
			$user->image_pass = $image;
		}
		$user->name = $data->name;
		$user->email = $data->email;
		$user->age = $data->age;
		$user->sex = $data->sex;
		$user->insurance_company = $data->insurance_company;
		$user->spouse = $data->spouse;
		$user->children = $data->children;
		$user->house_type = $data->house_type;
		$user->pref = $data->pref;
		$user->free_comment = $data->free_comment;
		$user->save();
		return true;
	}

	public function updatePass($data)
	{
		$user = $this->getDetailById(Auth::id());
		$user->password = bcrypt($data->password);
		$user->save();
		return true;
	}

	public function getUserByEmail($email)
	{
		if ($this->where('email', $email)->exists()) {
			$user = $this->where('email', $email)->first();
			return $user;
		} else {
			return false;
		}
	}

	public function getGoodCommentsByDay($day)
	{
		$users = $this->withCount('comments')->whereHas('comments', function ($query) use ($day) {
			$query->whereDate('created_at', '>=', $day);
		})->with(['comments' => function ($query) {
			$query->withCount('goods');
		}])->get();
		return $users;
	}
}
