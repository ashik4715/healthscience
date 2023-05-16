<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Customaccept extends Mailable
{
    use Queueable, SerializesModels;

    public $submit;
    public $user;
    public $body;

    public function __construct($submit, $user, $body) {
        $this->submit = $submit;
        $this->user = $user;
        $this->body = $body;
    }
    public function build()
    {
        return $this->subject("Your paper has been accepted")->view('mail.customaccept')->with('submit', $this->submit)->with('user', $this->user)->with('body', $this->body);
    }
}
