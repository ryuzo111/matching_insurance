<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact;
    protected $admin_email;
    protected $user_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact, $admin_email, $user_email)
    {
        $this->contact = $contact;
        $this->admin_email = $admin_email;
        $this->user_email = $user_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->admin_email, 'お問い合わせ')->view('contact.admin_mail')->with(['contact' => $this->contact, 'email' => $this->user_email]);
    }
}
