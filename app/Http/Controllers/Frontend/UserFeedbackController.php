<?php

namespace App\Http\Controllers\Frontend;


use App\Models\Author\Submit;
use App\Models\Contact;
use App\Models\UserFeedback;
use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserFeedbackController extends Controller
{

    public function create()
    {
        $contact = Contact::all();
        return view('website.pages.user_feedback',compact('contact'));
    }


    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        UserFeedback::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'pre_publish' => $request->pre_publish,
                'recommend_email' => $request->recommend_email,
            ]
        );
        return redirect('/');
    }

    public function show(UserFeedback $userFeedback)
    {
        //
    }

    public function edit(UserFeedback $userFeedback)
    {
        //
    }

    public function update(Request $request, UserFeedback $userFeedback)
    {
        //
    }


    public function destroy(UserFeedback $userFeedback)
    {
        //
    }

    public function view_count_submit(Request $request)
    {
      $submit = Submit::find($request->article_id);
      $submit->view_count = $submit->view_count+1;
      $submit->save();
      return $submit;
    }
}
