<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
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
}
