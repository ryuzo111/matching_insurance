<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
	use SoftDeletes;

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


	public function storeAndGetUpdatedChatList($request)
	{
		$this->create([
			'receive_user_id' => $request['receive_user_id'],
			'send_user_id' => $request['send_user_id'],
			'message' => $request['message'],
		]);

		$updated_chat_list = $this->where(function($query) use ($request){
			$query->where('receive_user_id', $request['receive_user_id'])
				->where('send_user_id', $request['send_user_id'])
				->where('created_at', '>', $request['created_at']);
		})->orWhere(function($query) use ($request) {
			$query->where('receive_user_id', $request['send_user_id'])
				->where('send_user_id', $request['receive_user_id'])
				->where('created_at', '>', $request['created_at']);
		})->get();
		return $updated_chat_list;
	}

	public function deleteChat($request)
	{
		$list = $this->where('created_at', $request['created_at'])
			->where('receive_user_id', $request['receive_user_id'])
			->where('send_user_id', $request['send_user_id'])
			->delete();
		return $list;	
	}

	public function editAndGetUpdatedChatList($request)
	{
		$target_chat = $this->where('created_at', $request['created_at'])
			->where('receive_user_id', $request['receive_user_id'])
			->where('send_user_id', $request['send_user_id'])->first();
		$target_chat->message = $request['message'];
		$target_chat->save();

		$updated_chat_list = $this->where(function($query) use ($request){
			$query->where('receive_user_id', $request['receive_user_id'])
				->where('send_user_id', $request['send_user_id'])
				->where('created_at', $request['created_at']);
		})->orWhere(function($query) use ($request) {
			$query->where('receive_user_id', $request['send_user_id'])
				->where('send_user_id', $request['receive_user_id'])
				->where('created_at', $request['created_at']);
		})->get();
		return $updated_chat_list;
		
	}


}
