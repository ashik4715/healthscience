<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;

class AboutController extends Controller
{

    public function index()
    {
        $about = About::all();
        $pictures = Image::all();
        return view('admin.about_us.index', compact(['about','pictures']));
    }

    public function create()
    {
        $already_exists = About::first();
        if ($already_exists) {
            session()->flash('message', 'You already have about us contents. Please, edit contents or delete content and create a new.');
            return redirect()->route('admin.about-us.index');
        }
        return view('admin.about_us.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'peer_review' => 'required',
            'broad_scope' => 'required',
            'indexed' => 'required',
            'open_access' => 'required',
            'fast_track_peer' => 'required',
            'membership_image' => 'nullable',
            'filename' => 'required',
            'filename.*' => 'image'
        ]);

        About::create(
            [
                'description' => $request->description,
                'peer_review' => $request->peer_review,
                'broad_scope' => $request->broad_scope,
                'indexed' => $request->indexed,
                'open_access' => $request->open_access,
                'fast_track_peer' => $request->fast_track_peer,
                'membership_image' => $request->membership_image,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

//        $about_id = About::where('peer_review',$request->peer_review);
//        $about_find = About::find($about_id);
//        dd($about_find);

        if($request->hasfile('filename'))
        {

            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/storage/images/', $name);
                $data[] = '/storage/images/'.$name;
            }
        }

        $image_model= new Image();
        $image_model->image=json_encode($data);

        try{
            $image_model->save();
        }catch (\Exception $e){
            return back()->with('danger', 'Images upload failed');
        }

        return redirect()->route('admin.about-us.index');
    }

    public function show(About $about)
    {
        //
    }

    public function edit($about)
    {
        $about = About::find($about);
        $pictures = Image::all();
        return view('admin.about_us.edit', compact(['about','pictures']));
    }


    public function update(Request $request, About $about_us)
    {
        $request->validate([
            'description' => 'required',
            'peer_review' => 'required',
            'broad_scope' => 'required',
            'indexed' => 'required',
            'open_access' => 'required',
            'fast_track_peer' => 'required',
            'membership_image' => 'nullable',
            'filename' => 'nullable',
            'filename.*' => 'image'
        ]);

        $about_us->update(
            [
                'description' => $request->description,
                'peer_review' => $request->peer_review,
                'broad_scope' => $request->broad_scope,
                'indexed' => $request->indexed,
                'open_access' => $request->open_access,
                'fast_track_peer' => $request->fast_track_peer,
                'membership_image' => $request->membership_image,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        if($request->hasfile('filename'))
        {

            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/storage/images/', $name);
                $data[] = '/storage/images/'.$name;
            }
            $image_model= new Image();
            $image_model->image=json_encode($data);

            try{
                $image_model->save();
            }catch (\Exception $e){
                return back()->with('danger', 'Images upload failed');
            }
        }

        return redirect()->route('admin.about-us.index');

    }

    public function destroy(About $about_us)
    {
        try {
            $about_us->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete about information');
        }
        return redirect()->route('admin.about-us.index');
    }
}
