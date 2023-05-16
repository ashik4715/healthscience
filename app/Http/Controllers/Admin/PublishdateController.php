<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublishDate;
use App\Models\Submission_timer;
use Illuminate\Http\Request;
use Auth;

class PublishdateController extends Controller
{
    public function index()
    {
        $publish_dates = PublishDate::orderBy('id', 'DESC')->get();
        return view('admin.publish_date.index',compact('publish_dates'));
    }


    public function create()
    {
        $timers = Submission_timer::orderBy('id', 'DESC')->get();
        return view('admin.publish_date.create',compact('timers'));
    }

    public function store(Request $request)
    {

         $this->validate($request, [
             'timer_id' => 'required|unique:publish_dates',
             'publish' => 'required',
             'status' => 'required',
         ]);

        $publish_date = new PublishDate();
        $publish_date->user_id = Auth::user()->id;
        $publish_date->timer_id = $request->timer_id;
        $publish_date->publish_date = $request->publish;
        $publish_date->status = $request->status;
        $publish_date->save();


        try{
            $publish_date->save();
        }catch (\Exception $exception){
            return back()->with('danger', 'Something wrong');
        }
        return redirect()->route('admin.publish.index');
    }

    public function show(publish_date $publish_date)
    {
        //
    }


    public function edit($id)
    {   
        $timers = Submission_timer::all();
        $publish_date = PublishDate::find($id);
        return view('admin.publish_date.edit',compact('publish_date','timers'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'timer_id' => 'required|unique:publish_dates,publish_date,'.$id,
            'publish' => 'required',
            'status' => 'required',
        ]);
        $publish_date = PublishDate::find($id);

        $publish_date->user_id = Auth::user()->id;
        $publish_date->timer_id = $request->timer_id;
        $publish_date->deadline = $request->deadline;
        $publish_date->publish_on = $request->publish;
        $publish_date->status = $request->status;

        try{
            $publish_date->save();
        }catch (\Exception $exception){
            return back()->with('danger', 'Something wrong');
        }
        return redirect()->route('admin.publish.index');
    }

    public function destroy(Request $request, $id)
    {
        $publish_date = PublishDate::find($id);
        try {
            $publish_date->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete content Publish Date');
        }
        return back();
    }
}
