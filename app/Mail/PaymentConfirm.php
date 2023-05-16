<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $paper_id;
    public $payment_id;
    public $billing_name;
    public $amount;
    public $info;

    public function __construct($paper_id, $payment_id, $billing_name, $amount, $info)
    {
        $this->paper_id = $paper_id;
        $this->payment_id = $payment_id;
        $this->amount = $amount;
        $this->billing_name = $billing_name;
        $this->info = $info;
    }

    public function build()
    {
        return $this->subject('Your payment has been successful!')->view('mail.payment_confirm', compact('paper_id','payment_id', 'amount','billing_name', 'info'));
    }
}
