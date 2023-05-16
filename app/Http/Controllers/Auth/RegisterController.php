<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerificationMail;
use App\User;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/author/dashboard';

    public function __construct()
    {
        $this->middleware('guest');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'prefix' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'string','email', 'max:255', 'unique:users'],
            'address' => 'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $request = request();
        $image = $request->file('image');
        $slug = str_slug($data['firstname']);
        if (isset($image)){
            $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('images/author_profile')){
                mkdir('images/author_profile', 0777, true);
            }

            $image->move('images/author_profile', $imagename);
        }else{
            $imagename = 'default.png';
        }
        $user = User::create([
            'role_id' => 2,
            'prefix' => $data['prefix'],
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'institution' => $data['institution'],
            'department' => $data['department'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'image' => $imagename,
            'verifyToken' => Str::random(40),
        ]);
        $thisuser = User::find($user->id);
        $this->sendMail($thisuser);
        return $user;
    }

    public function sendMail($thisuser){
        Mail::to($thisuser->email)->queue(new VerificationMail($thisuser));
    }

    public  function authormailverification(){
        return view('mail.verification');
    }

    public  function authormailverificationdone($token, $id){
        $user = User::where(['id' => $id, 'verifyToken' => $token])->first();
        if ($user){
            User::where(['id' => $id, 'verifyToken' => $token])->update(['status' => 1, 'verifyToken' => null, 'email_verified_at'=>  now()]);
            return redirect()->route('authorlogin')->with('success','Registration Process Completed! you may Login now!');
        }else{
            return view('mail.expirelink');
        }
    }



}
