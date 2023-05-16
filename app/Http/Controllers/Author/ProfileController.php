<?php

namespace App\Http\Controllers\Author;

use App\Models\Author\Submit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Redirect;

use Hash;

class ProfileController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $submits = Submit::orderBy('id','desc')->where('user_id', Auth::user()->id)->paginate(5);
        return view('author.pages.profile.show', compact('submits'));
    }


    public function edit($id)
    {
        $profile = User::find($id);
        return view('author.pages.profile.edit', compact('profile'));
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
        ]);


        $image = $request->file('image');
        $slug = str_slug($request->firstname);
        if ($image){
            $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('images/author_profile/')){
                mkdir('images/author_profile/', 0777, true);
            }

            $image->move('images/author_profile/', $imagename);
            $user->image = $imagename;
        }

        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->institution = $request->institution;
        $user->department = $request->department;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);

        $user->update();

        return Redirect::back();
    }


    public function destroy($id)
    {
        //
    }
}
