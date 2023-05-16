<?php
namespace App\Mail;

use App\Models\Author\Submit;
use App\Models\Category;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendpostMail extends Mailable {
  use Queueable, SerializesModels;

  public $submit;
  public $user;
  public $category;

  public function __construct(Submit $submit, User $user, Category $category) {
    $this->submit = $submit;
    $this->user = $user;
    $this->category = $category;
  }

  public function build() {
    return $this->subject('Thank your for your submission')->view('mail.sendpostlink')->with('submit', $this->submit)->with('category', $this->category)->with('user', $this->user);
  }
}
