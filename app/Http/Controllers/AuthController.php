<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeMail;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $username = $user->name;
        $useremail = $user->email;
        return redirect()->route('authorregister')->with('username', $username)->with('useremail', $useremail);
    }

    public function subscribe(Request $request){
        $rules = array(
            'category_id' => 'required',
            'email' => 'required|email|unique:subscribes',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()){
            return response()->json(['errors'=> 'OPPS! Something wrong! Already subscribe with this Email']);
        }
        $subscribe = new Subscribe;
        $subscribe->category_id = $request->category_id;
        $subscribe->email = $request->email;
        $subscribe->status = 0;
        $subscribe->save();
        $mail = $request->email;
        Mail::to($mail)->queue(new SubscribeMail());
        return response()->json(['success' => 'Thank you for your subscription']);

    }
}
