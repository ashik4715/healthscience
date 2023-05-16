<?php

namespace App\Http\Controllers\Admin;

use App\Models\ImageSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageSliderController extends Controller
{
    public function index()
    {
        $images = ImageSlider::all();
        return view('admin.image_slider.all',compact('images'));
    }

    public function create()
    {
        return view('admin.image_slider.new');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg,png,webp',
            'title' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image)){
            $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('images/slider_images')){
                mkdir('images/slider_images',0777, true);
            }
            $image->move('images/slider_images',$imagename);
        }

        $ImageSlider = new ImageSlider();
        $ImageSlider->title = $request->title;
        $ImageSlider->description = $request->description;
        $ImageSlider->image = $imagename;


        try{
            $ImageSlider->save();
        }catch (\Exception $exception){
            return back()->with('danger', 'Something wrong');
        }

        return redirect()->route('admin.slider-image.index');
    }

    public function edit($id)
    {
        $image = ImageSlider::find($id);
        return view('admin.image_slider.edit',compact('image'));
    }

    public function show()
    {

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $image = $request->file('image');
        $ImageSlider = ImageSlider::find($id);

        if (isset($image)){
            $slug = str_slug($request->title);
            if (file_exists('images/slider_images/'.$ImageSlider->image)){
                unlink('images/slider_images/'.$ImageSlider->image);
            }
            $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('images/slider_images')){
                mkdir('images/slider_images',0777, true);
            }
            $image->move('images/slider_images',$imagename);
            $ImageSlider->image = $imagename;
        }
        $ImageSlider->title = $request->title;
        $ImageSlider->description = $request->description;

        try{
            $ImageSlider->save();
        }catch (Exception $exception){
            return back()->with('danger', 'Something wrong');
        }
        return redirect()->route('admin.slider-image.index');
    }


    public function destroy($id)
    {
        $ImageSlider = ImageSlider::find($id);
        if (file_exists('images/slider_images/'.$ImageSlider->image)){
            unlink('images/slider_images/'.$ImageSlider->image);
        }
        $ImageSlider->delete();
        return back();
    }
}
