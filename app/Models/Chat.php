<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
	use SoftDeletes;

	public function send_user()
	{
		return $this->hasOne('App\Models\User', 'id', 'send_user_id');
	}

	public function receive_user()
	{
		return $this->hasOne('App\Models\User', 'id', 'receive_user_id');
	}

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

	public function getChatListByUserId($user_id)
	{
		//誰にchatを送信したか
		$dm_started_user_list = $this->where('send_user_id', $user_id)->distinct()
			->select('receive_user_id')->get();
		//誰からchatが送信されたか
		$dm_not_started_user_list = $this->where('receive_user_id', $user_id)->distinct()
			->select('send_user_id')->get();

		foreach ($dm_not_started_user_list as $key => $send_user) {
			//既にchatを送信していたら除外
			if (!empty($this->where('send_user_id', $user_id)->where('receive_user_id', $send_user->send_user_id)->first())) {
				$dm_not_started_user_list->forget($key);
			}
		}
		
		//DM一覧を取得
		$dm_started_chat_list = [];
		foreach ($dm_started_user_list as $key => $dm_started_user) {
			$dm_started_chat_list[$key]['user_id'] = $dm_started_user->receive_user_id;
			$the_other_user = User::where('id', $dm_started_chat_list[$key]['user_id'])->first();
			$dm_started_chat_list[$key]['user_name'] = $the_other_user->name;		
			$dm_started_chat_list[$key]['image_pass'] = $the_other_user->image_pass;		
			$dm_started_chat_list[$key]['message'] = $this->getLatestChatBetweenTwoPersons($dm_started_chat_list[$key]['user_id'], $user_id)->message;
			$dm_started_chat_list[$key]['created_at'] = $this->getLatestChatBetweenTwoPersons($dm_started_chat_list[$key]['user_id'], $user_id)->created_at;			
		}
		
		//まだ開始していないDM一覧を取得
		$dm_not_started_chat_list = [];
		foreach ($dm_not_started_user_list as $key => $dm_not_started_user) {
			$dm_not_started_chat_list[$key]['user_id'] = $dm_not_started_user->send_user_id;

			$the_other_user = User::where('id', $dm_not_started_chat_list[$key]['user_id'])->first();
			$dm_not_started_chat_list[$key]['user_name'] = $the_other_user->name;		
			$dm_not_started_chat_list[$key]['image_pass'] = $the_other_user->image_pass;		
			$dm_not_started_chat_list[$key]['message'] = $this->getLatestChatBetweenTwoPersons($dm_not_started_chat_list[$key]['user_id'], $user_id)->message;
			$dm_not_started_chat_list[$key]['created_at'] = $this->getLatestChatBetweenTwoPersons($dm_not_started_chat_list[$key]['user_id'], $user_id)->created_at;			
		}
		return [$dm_started_chat_list, $dm_not_started_chat_list];
	}

	public function getLatestChatBetweenTwoPersons($receive_user_id, $send_user_id)
	{
		$chat = $this->where(function($query) use ($receive_user_id, $send_user_id){
			$query->where('receive_user_id', $receive_user_id)
				->where('send_user_id', $send_user_id);
		})->orWhere(function($query) use ($receive_user_id, $send_user_id) {
			$query->where('receive_user_id', $send_user_id)
				->where('send_user_id', $receive_user_id);
		})->orderBy('created_at', 'desc')->first();
		return $chat;
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
