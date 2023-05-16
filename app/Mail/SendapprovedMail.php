<?php
namespace App\Mail;

use App\Models\Author\Submit;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendapprovedMail extends Mailable {
  use Queueable, SerializesModels;


  public $submit;
  public $user;

  public function __construct($submit, $user) {
    $this->submit = $submit;
    $this->user = $user;
  }


  public function build() {
    return $this->subject("Your paper has been accepted")->view('mail.sendapproved')->with('submit', $this->submit)->with('user', $this->user);
  }
}
