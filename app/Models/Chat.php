<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
	protected $guarded = ['id'];

	public function getChatsBetweenTwoPersons($receive_user_id, $send_user_id)
	{
		$chats = $this->where(function($query) use ($receive_user_id, $send_user_id){
			$query->where('receive_user_id', $receive_user_id)
				->where('send_user_id', $send_user_id);
		})->orWhere(function($query) use ($receive_user_id, $send_user_id) {
			$query->where('receive_user_id', $send_user_id)
				->where('send_user_id', $receive_user_id);
		})->get();
		return $chats;
	}


	public function createChat($request, $receive_user, $send_user)
	{
		$this->create([
			'receive_user_id' => $receive_user->id,
			'send_user_id' => $send_user->id,
			'message' => $request->message,
		]);
		return true;
	}



}
