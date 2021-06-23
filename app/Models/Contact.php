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

    public function getPaginateContacts()
    {
        return $this->orderBy('created_at', 'desc')->paginate(10);
    }

    public function getContactById($id)
    {
        return $this->findOrFail($id);
    }

    public function updateStatusById($id)
    {
        $target_contact = $this->findOrFail($id);
        if ($target_contact->status === config('status.resolved')) {
            return false;
        }
        $target_contact->status = ++$target_contact->status;
        $target_contact->save();
        return true;
    }
}
