<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Admin;
use App\Models\User;
use App\Http\Requests\SaveContactRule;
use App\Http\Requests\SendAnswerRule;
use App\Mail\ContactAdmin;
use App\Mail\ContactUser;
use App\Mail\ContactAnswer;
use Mail;

class ContactController extends Controller
{

    public function __construct(Contact $contact, Admin $admin, User $user)
    {
        $this->contact = $contact;
        $this->admin = $admin;
        $this->user = $user;
    }

    public function contactForm()
    {
        return view('contact.contact');
    }

    public function contact(SaveContactRule $request)
    {
        $user_email = $this->contact->saveContact($request); //saveContact()は未ログイン者かつ、メールアドレス未入力の場合はfalseを返す。成功時はメールアドレスを返す
        if ($user_email === false) {
            session()->flash('error', 'メールアドレスを入力してください');
            return back();
        } else {
            $main_admin = $this->admin->getMainAdmin();
            Mail::send(new ContactAdmin($request->input('content'), $main_admin->email, $user_email));
            Mail::send(new ContactUser($request->input('content'), $user_email));
            session()->flash('success', 'お問い合わせありがとうございます');
            return redirect()->route('post.index');
        }
    }
    public function index()
    {
        $contacts = $this->contact->getPaginateContacts();
        return view('contact.index', compact('contacts'));
    }

    public function showAnswerForm(Request $request)
    {
        $contact = $this->contact->getContactById($request->input('contact_id'));
        $user = $this->user->getUserByEmail($contact->email);
        if ($contact->status === config('status.resolved')) {
            return redirect()->route('contact.index')->with('error', 'このお問い合わせは既に解決しております');
        }

        if ($user === false) {
            return view('contact.answer_form', compact('contact'));
        } else {
            return view('contact.answer_form', compact('contact', 'user'));
        }
    }

    public function answer(SendAnswerRule $request)
    {
        $contact = $this->contact->getContactById($request->input('contact_id'));
        if ($contact->status === config('status.resolved')) {
            return redirect()->route('contact.index')->with('error', 'このお問い合わせは既に解決しております');
        }
        Mail::send(new ContactAnswer($contact, $request->input('answer')));
        return redirect()->route('contact.index')->with('success', 'お問い合わせ者に回答を送信いたしました');
    }

    public function changeStatus(Request $request)
    {
        $result = $this->contact->updateStatusById($request->input('contact_id'));
        if ($result === false) {
            return redirect()->route('contact.index')->with('error', 'このお問い合わせは既に解決しております');
        }
        return redirect()->route('contact.index')->with('success', '回答状況を変更いたしました');
    }
}
