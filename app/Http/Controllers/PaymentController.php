<?php

namespace App\Http\Controllers;

use App\Payment\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public  function payments(){
      dd('hello');
      return view('website.pages.payments');
    }

    public  function get(){
      return view('website.pages.payments');


//      return view('payment');
    }


    public  function checkout(){
        return view('checkout');
    }


    public function pay(Request $request){
//        return $request;
        $address = $request->addinfo;
        $token = $request->token;
        $paymentinfo = [
            "sellerId" => env('2CHECKOUT_SELLER_ID'),
            "merchantId" => rand(1000,10000),
            "token" => $token,
            "currency" => 'USD',
            "total" => '20.00',
            "billingAddr" => $address,
        ];
//        return $paymentinfo;
        $response = Payment::pay($paymentinfo);

        if (!$response['success']){
            return response(['message' => $response['message']], 400);
        }

        return ['message' => 'Successfully paid'];
    }
}
