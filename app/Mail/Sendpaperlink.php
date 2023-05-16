<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Sendpaperlink extends Mailable
{
    use Queueable, SerializesModels;

    public $info;
    public $url;

    public function __construct($info, $url)
    {
        $this->info = $info;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject("Requested Paper Link")->view('mail.sendpaperlink')->with('info', $this->info)->with('url', $this->url);
    }
}
