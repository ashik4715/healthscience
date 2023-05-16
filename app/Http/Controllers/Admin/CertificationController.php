<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificationController extends Controller
{

    public function index()
    {
        $images = Certification::orderBy('id', 'DESC')->get();

        return view('admin.certifications.all', compact('images'));
    }

    public function create()
    {
        return view('admin.certifications.new');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'image' => 'required|mimes:jpeg,jpg,png',
            'status' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)){
            $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!file_exists('images/certifications')){
                mkdir('images/certifications', 0777, true);
            }

            $image->move('images/certifications', $imagename);
        }

        $image = new Certification();
        $image->title = $request->title;
        $image->image = $imagename;
        $image->status = $request->status;

      try{
            $image->save();
        }catch(\Exception $exception){
            return back();
        }

        return redirect()->route('admin.certifications.index');
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $image = Certification::find($id);
        return view('admin.certifications.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
              'title' => 'required|max:100',
//              'image' => 'required|mimes:jpeg,jpg,png',
              'status' => 'required',
      ]);
      $img = $request->file('image');
      $slug = str_slug($request->title);
      $image = Certification::find($id);

      if (isset($img)){
        unlink('images/certifications/'.$image->image);

        $imagename = $slug.'-'.uniqid().'.'.$img->getClientOriginalExtension();

        if (!file_exists('images/certifications')){
          mkdir('images/certifications', 0777, true);
        }

        $img->move('images/certifications', $imagename);
        $image->image = $imagename;
      }

      $image->title = $request->title;
      $image->status = $request->status;

      try{
        $image->save();
      }catch(\Exception $exception){
        return back();
      }

      return redirect()->route('admin.certifications.index');
    }


    public function destroy($id)
    {
      $certification = Certification::find($id);
      if (file_exists('images/certifications/'.$certification->image)){
        unlink('images/certifications/'.$certification->image);
      }
      $certification->delete();
      return back();
    }
}
