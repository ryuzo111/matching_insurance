<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    public function saveContact($request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->email = $user->email;
        } else {
            if (!empty($request->input('email'))) {  //ログインしていない場合で、メールアドレスを入力していない場合、保存させないようにするため
                $this->email = $request->input('email');
            } else {
                return false;
            }
        }
        $this->content = $request->input('content');
        $this->save();
        return $this->email;
    }
}
