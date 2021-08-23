<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendChatRule;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function __construct(Chat $chat, User $user)
    {
        $this->chat = $chat;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (is_null($request->send_user_id)) {
            return redirect()->route('post.index');
        }
        // 送信者がログインユーザでない場合
        if ($request->send_user_id != Auth::id()) {
            return redirect(route('post.index'))->with('error', '不正な値が検知されました。');
        }
        //受信者と送信者が同一である場合
        if ($request->receive_user_id == $request->send_user_id) {
            return redirect(route('post.index'))->with('error', '送信できません');
        }
        $receive_user = $this->user->getDetailById($request->receive_user_id);
        $send_user = $this->user->getDetailById($request->send_user_id);
        return view('chat/index', compact('receive_user', 'send_user'));
    }

    public function list()
    {
        list($dm_started_list, $dm_not_started_list) = $this->chat->getChatListByUserId(Auth::id());
		return view('chat/list', compact('dm_started_list', 'dm_not_started_list'));
    }

    public function getData(User $receive_user, User $send_user)
	{
        $chats = $this->chat->getChatsBetweenTwoPersons($receive_user->id, $send_user->id);
		$json = ['chats' => $chats, 'receive_user' => $receive_user, 'send_user' => $send_user];
		return response()->json($json);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(SendChatRule $request, User $receive_user, User $send_user )
    // {
    //     //送信者がログインユーザでない場合
    //     if ($send_user->id != Auth::id()) {
    //         return redirect()->back()->with('error', '不正な値が検知されました。');
    //     }

    //     //受信者と送信者が同一である場合
    //     if ($receive_user == $send_user) {
    //         return redirect()->back()->with('error', '送信できません。');
    //     }
    //     //保存
    //     $this->chat->createChat($request, $receive_user, $send_user);
    //     return redirect()->back()->with('success', '送信しました。');
    // }

    public function sendMessage(Request $request)
    {
        $updated_chat_list = $this->chat->storeAndGetUpdatedChatList($request);

        $json = ['chats' => $updated_chat_list];
		return response()->json($json);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeMessage(Request $request)
    {
        $list = $this->chat->deleteChat($request);
        $json = ['chats' => $list];
		return response()->json($json);

    }

    public function editMessage(Request $request)
    {
        $updated_chat_list = $this->chat->editAndGetUpdatedChatList($request);

        $json = ['chats' => $updated_chat_list];
		return response()->json($json);

    }
}
