<?php
namespace App\Payment;

use Exception;
use Twocheckout;
use Twocheckout_Charge;

class Payment {
  public static function pay($paymentinfo) {
    Twocheckout::privateKey(env('2CHECKOUT_PRIVATE_KEY'));
    Twocheckout::sellerId(env('2CHECKOUT_SELLER_ID'));
    Twocheckout::verifySSL(!(bool) env('2CHECKOUT_IS-SANDBOX'));
    Twocheckout::sandbox((bool) env('2CHECKOUT_IS-SANDBOX'));
    Twocheckout::format('json');
    try {
      $charge = Twocheckout_Charge::auth($paymentinfo, 'array');
      if ($charge['response']['responseCode'] == 'APPROVED') {
        return ['success' => true, 'payload' => $charge];
      }
    } catch (Exception $exception) {
      return ['success' => false, 'message' => $exception->getMessage()];
    }
    return ['success' => false, 'message' => 'Something went wrong!'];
  }
}