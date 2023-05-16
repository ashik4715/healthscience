<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $subject;
    public $message;
    public $name;
    public $category;
    public function __construct($subject, $message, $name, $category)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->name = $name;
        $this->category = $category;
    }

    public function build()
    {
        return $this->subject($this->subject)->view('mail.sendmail')->with('body', $this->message)->with('name', $this->name)->with('category', $this->category);
    }
}
