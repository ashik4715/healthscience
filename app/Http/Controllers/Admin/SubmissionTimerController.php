<?php

namespace App\Http\Controllers\Admin;

use App\Models\Submission_timer;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SubmissionTimerController extends Controller
{

    public function index()
    {
        $submission_timers = Submission_timer::orderBy('id', 'DESC')->get();
        return view('admin.submission_timer.index',compact('submission_timers'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.submission_timer.create',compact('categories'));
    }

    public function store(Request $request)
    {

         $this->validate($request, [
             'volume' => 'required',
             'issue' => 'required',
             'category' => 'required',
             'deadline' => 'required',
             'publish' => 'required',
             'status' => 'required',
         ]);
        $category = Category::find($request->category);

        if (!file_exists('volume/'.$category->tag.'/'.$request->volume.'/'.$request->issue)){
          $path = 'volume/'.$category->tag.'/'.$request->volume.'/'.$request->issue;
          mkdir($path, 0777, true) || chmod($path, 0777);
        }


        $submission_timer = new Submission_timer();
        $submission_timer->volume = $request->volume;
        $submission_timer->issue = $request->issue;
        $submission_timer->cat_folder = $category->tag;
        $submission_timer->category_id = $request->category;
        $submission_timer->deadline = $request->deadline;
        $submission_timer->publish_on = $request->publish;
        $submission_timer->status = $request->status;
        $submission_timer->save();


        try{
            $Submission_timer->save();
        }catch (\Exception $exception){
            return back()->with('danger', 'Something wrong');
        }
        return redirect()->route('admin.submission-timer.index');
    }

    public function show(Submission_timer $submission_timer)
    {
        //
    }


    public function edit($id)
    {   
        $categories = Category::all();
        $submission_timer = Submission_timer::find($id);
        return view('admin.submission_timer.edit',compact('submission_timer','categories'));
    }

    public function update(Request $request, $id)
    {
        // return $request;
        $submission_timer = Submission_timer::find($id);

        $submission_timer->volume = $request->volume;
        $submission_timer->issue = $request->issue;
        $submission_timer->category_id = $request->category;
        $submission_timer->deadline = $request->deadline;
        $submission_timer->publish_on = $request->publish;
        $submission_timer->status = $request->status;

        try{
            $submission_timer->save();
        }catch (\Exception $exception){
            return back()->with('danger', 'Something wrong');
        }
        return redirect()->route('admin.submission-timer.index');
    }

    public function destroy(Request $request, $id)
    {
        $Submission_timer = Submission_timer::find($id);
        try {
            $Submission_timer->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete content Terms & Conditions');
        }
        return back();
    }
}
