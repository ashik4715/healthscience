<?php

namespace App\Http\Controllers\Admin;


use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{

  public function index()
  {
    $blogs = Blog::all();
    return view('admin.blog.index',compact('blogs'));
  }


  public function create()
  {
    return view('admin.blog.create');

  }


  public function store(Request $request)
  {

    $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,webp',
    ]);

    $blog = new Blog();
    $image = $request->file('image');
    if (isset($image)){
      $slug = str_slug($request->title);
      $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
      $image->move('images/SDIP_blog',$imagename);
      $blog->image = $imagename;
    }

    $blog->title = $request->title;
    $blog->description = $request->description;

    $blog->meta_title = $request->meta_title;
    $blog->meta_description = $request->meta_description;


    try{
      $blog->save();
    }catch (\Exception $exception){
      return back()->with('danger', 'Something wrong');
    }

    return redirect()->route('admin.blog.index');
  }


  public function show(Blog $announcements)
  {
    //
  }


  public function edit($id)
  {
    $blog = Blog::find($id);
    return view('admin.blog.edit',compact('blog'));
  }


  public function update(Request $request, $id)
  {

      $request->validate([
              'title' => 'required',
              'image' => 'mimes:jpeg,jpg,png,webp',
              'description' => 'required',
      ]);

    $blog = Blog::find($id);

    $image = $request->file('image');
    if (isset($image)){
      $slug = str_slug($request->title);
      if (file_exists('/images/SDIP_blog/'.$blog->image)){
        unlink('/images/SDIP_blog'.$blog->image);
      }
      $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
      $image->move('images/SDIP_blog',$imagename);
      $blog->image = $imagename;
    }
    $blog->title = $request->title;
    $blog->description = $request->description;
    $blog->meta_title = $request->meta_title;
    $blog->meta_description = $request->meta_description;

    try{
      $blog->save();
    }catch (\Exception $exception){
      return back()->with('danger', 'Something wrong');
    }
    return redirect()->route('admin.blog.index');
  }

  public function destroy($id)
  {
    $blog = Blog::find($id);
    if (file_exists('/images/SDIP_blog'.$blog->image)){
      unlink('/images/SDIP_blog'.$blog->image);
    }
    $blog->delete();
    return back();
  }

}
