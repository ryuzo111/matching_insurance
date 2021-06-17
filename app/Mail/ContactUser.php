<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact, $email)
    {
        $this->contact = $contact;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email, 'お問い合わせ')->view('contact.user_mail')->with(['contact' => $this->contact]);
    }
}
