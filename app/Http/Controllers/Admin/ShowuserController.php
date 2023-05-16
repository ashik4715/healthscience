<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Discount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShowuserController extends Controller
{

    public function index()
    {
        $authors = User::where('role_id',2)->orderBy('id','DESC')->get();
        return view('admin.author.show_author.all', compact('authors'));
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
        //
    }


    public function edit($id)
    {
        $profile = User::find($id);
        return view('admin.author.show_author.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->discount = $request->discount;

        $user->update();

        Mail::to($user->email)->queue(new Discount($user));

        return redirect()->route('admin.show-author.index');
    }

    public function destroy($id)
    {
        //
    }
}
