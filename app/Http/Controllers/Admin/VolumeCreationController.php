<?php

namespace App\Http\Controllers\Admin;

use App\Models\VolumeCreation;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VolumeCreationController extends Controller
{

    public function index()
    {
      return view('admin.SDIP_volume_creation.index');
    }


    public function create()
    {
       $categories = Category::all();
       return view('admin.SDIP_volume_creation.create',compact('categories'));
    }

    public function store(Request $request)
    {
      $Submission_timer = new VolumeCreation();

      $Submission_timer->volume = $request->volume;
      $Submission_timer->issue = $request->issue;
      $Submission_timer->category = $request->category;


      try{
        $Submission_timer->save();
      }catch (\Exception $exception){
        return back()->with('danger', 'Something wrong');
      }
      return redirect()->route('admin.submission-timer.index');
    }

    public function show(VolumeCreation $volumeCreation)
    {
        //
    }

    public function edit(VolumeCreation $volumeCreation)
    {
        //
    }

    public function update(Request $request, VolumeCreation $volumeCreation)
    {
        //
    }

    public function destroy(VolumeCreation $volumeCreation)
    {
        //
    }
}
