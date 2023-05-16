<?php

namespace App\Http\Controllers\Admin;

use App\Models\announcements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $announcements = announcements::all();
        return view('admin.announcements.index',compact('announcements'));
    }


    public function create()
    {
      return view('admin.announcements.create');

    }


    public function store(Request $request)
    {
      $this->validate($request, [
              'title' => 'required',
              'image' => 'required|mimes:jpeg,jpg,png,webp',
              'description' => 'required',
      ]);


      $image = $request->file('image');
      $slug = str_slug($request->title);

      if (isset($image)){
        $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        $image->move('images/announcements',$imagename);
      }

      $announcements = new announcements();
      $announcements->title = $request->title;
      $announcements->image = $imagename;
      $announcements->description = $request->description;
      $announcements->meta_title = $request->meta_title;
      $announcements->meta_description = $request->meta_description;

      try{
        $announcements->save();
      }catch (\Exception $exception){
        return back()->with('danger', 'Something wrong');
      }

      return redirect()->route('admin.announcement.index');
    }


    public function show(announcements $announcements)
    {
        //
    }


    public function edit($id)
    {
      $announcement = announcements::find($id);
      return view('admin.announcements.edit',compact('announcement'));
    }


    public function update(Request $request, $id)
    {

//      $request->validate([
//              'title' => 'required',
//              'image' => 'required|mimes:jpeg,jpg,png,webp',
//              'description' => 'required',
//      ]);

      $announcement = announcements::find($id);

      $image = $request->file('image');
      if (isset($image)){
        $slug = str_slug($request->title);
        unlink('images/announcements/'.$announcement->image);
        $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        $image->move('images/announcements/',$imagename);
        $announcement->image = $imagename;
      }
      $announcement->title = $request->title;
      $announcement->description = $request->description;
      $announcement->meta_title = $request->meta_title;
      $announcement->meta_description = $request->meta_description;

      try{
        $announcement->save();
      }catch (\Exception $exception){
        return back()->with('danger', 'Something wrong');
      }
      return redirect()->route('admin.announcement.index');
    }

    public function destroy($id)
    {
      $announcements = announcements::find($id);
      if (file_exists('images/announcements/'.$announcements->image)){
        unlink('images/announcements/'.$announcements->image);
      }
      $announcements->delete();
      return back();
    }
}
