<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Unpublished extends Mailable
{
    use Queueable, SerializesModels;

    public $submit;
    public $user;

    public function __construct($submit, $user)
    {
        $this->submit = $submit;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Sorry! Your paper has been Unpublished.")->view('mail.unpublished', compact('submit','user'));
    }
}
