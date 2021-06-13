<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Admin;
use App\Http\Requests\SaveContactRule;
use App\Mail\ContactAdmin;
use App\Mail\ContactUser;
use Mail;

class ContactController extends Controller
{

    public function __construct(Contact $contact, Admin $admin)
    {
        $this->contact = $contact;
        $this->admin = $admin;
    }

    public function contactForm()
    {
        return view('contact.contact');
    }

    public function contact(SaveContactRule $request)
    {
        $user_email = $this->contact->saveContact($request);
        if ($user_email === false) {
            session()->flash('error', 'メールアドレスを入力してください');
            return back();
        } else {
            $main_admin = $this->admin->getMainAdmin();
            Mail::send(new ContactAdmin($request->input('content'), $main_admin->email, $user_email));
            Mail::send(new ContactUser($request->input('content'), $user_email));
            session()->flash('success', 'お問い合わせありがとうございます');
            return view('contact.contact');
        }
    }
}
