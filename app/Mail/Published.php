<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Published extends Mailable
{
    use Queueable, SerializesModels;

    public $submit;
    public $user;
    public function __construct($submit, $user)
    {
        $this->submit = $submit;
        $this->user = $user;
    }


    public function build()
    {
        return $this->subject("Congratulations! Your paper has been Published.")->view('mail.published', compact('submit','user'));
    }
}
