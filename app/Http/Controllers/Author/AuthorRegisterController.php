<?php

namespace App\Http\Controllers\Author;

use App\Mail\VerificationMail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthorRegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/author/dashboard';

    public function __construct()
    {
        $this->middleware('guest');

    }
    public function index()
    {
        return view('author.register');
    }

    public function login()
    {
//        return "hello";
        return view('author.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'prefix' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'address' => 'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->firstname);
        if (isset($image)){
            $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('profile')){
                mkdir('profile', 0777, true);
            }

            $image->move('profile', $imagename);
        }else{
            $imagename = 'default.png';
        }


        $saveuser = User::create([
            'role_id' => 2,
            'prefix' => $request->prefix,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'institution' => $request->institution,
            'department' => $request->department,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'image' => $imagename,
        ]);

        Mail::to($saveuser->email)->send(new VerificationMail($saveuser));
        return back();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function verify($token)
    {
        //
    }
}
