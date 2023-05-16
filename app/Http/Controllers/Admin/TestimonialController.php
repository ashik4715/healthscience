<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::orderBy('id','DESC')->get();
        return view('admin.testimonial.all', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.new');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png',
            'name' => 'required|max:100',
            'designation' => 'required|max:100',
            'institution' => 'required|max:150'
        ]);
        $photo = $request->file('photo');
        $slug = str_slug($request->name);

        if (isset($photo)){
            $photoname = $slug.'-'.uniqid().'.'.$photo->getClientOriginalExtension();
            if (!file_exists('images/testimonials')){
                mkdir('images/testimonials',777, true);
            }
            $photo->move('images/testimonials',$photoname);
        }

        $testimonial = new Testimonial();
        $testimonial->description = $request->description;
        $testimonial->photo = $photoname;
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->institution = $request->institution;
        $testimonial->status = $request->status;
        $testimonial->save();

        return redirect()->route('admin.testimonial.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required',
            'name' => 'required|max:100',
            'designation' => 'required|max:100',
            'institution' => 'required|max:150'
        ]);
        $photo = $request->file('photo');
        $slug = str_slug($request->name);
        $testimonial = Testimonial::find($id);
        if (isset($photo)){
            unlink('images/testimonials/'.$testimonial->photo);
            $photoname = $slug.'-'.uniqid().'.'.$photo->getClientOriginalExtension();
            if (!file_exists('images/testimonials')){
                mkdir('images/testimonials',777, true);
            }
            $photo->move('images/testimonials',$photoname);
        }else{
            $photoname = $testimonial->photo;
        }


        $testimonial->description = $request->description;
        $testimonial->photo = $photoname;
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->institution = $request->institution;
        $testimonial->status = $request->status;
        $testimonial->save();

        return redirect()->route('admin.testimonial.index');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        if (file_exists('images/testimonials/'.$testimonial->photo)){
            unlink('images/testimonials/'.$testimonial->photo);
        }
        $testimonial->delete();
        return back();
    }
}
