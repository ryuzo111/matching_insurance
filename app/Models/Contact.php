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
            if (empty($request->input('email'))) {
                return false;
            }
            $this->email = $request->input('email');
        }

        $this->content = $request->input('content');
        $this->save();
        return $this->email;
    }

    public function getContact()
    {
        $contacts = $this->all();
        return $contacts->sortByDesc('created_at');
    }

    public function getContactById($id)
    {
        return $this->findOrFail($id);
    }

    public function updateStatusById($id)
    {
        $target_contact = $this->findOrFail($id);
        $target_contact->status = 1;
        $target_contact->save();
        return true;
    }
}
