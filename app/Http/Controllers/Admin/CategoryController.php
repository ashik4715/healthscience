<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('admin.category.all', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.new');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'logo' => 'required|mimes:jpeg,jpg,png',
            'name' => 'required',
            'tag' => 'required',
            'price' => 'required',
            'description' => 'required',
            'impact_factor' => 'required',
        ]);

        $logo = $request->file('logo');
        $slug = str_slug($request->name);

        if (isset($logo)){
            $logoname = $slug.'-'.uniqid().'.'.$logo->getClientOriginalExtension();

            if (!file_exists('images/category_logo')){
                mkdir('images/category_logo', 777, true);
            }
            $logo->move('images/category_logo',$logoname);
        }

        $category = new Category();

        try{
            $category::create(
                [
                    'logo' => $logoname,
                    'name' => $request->name,
                    'tag' => trim($request->tag),
                    'price' => trim($request->price),
                    'category_color' => $request->category_color,
                    'description' => $request->description,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'impact_factor' => $request->impact_factor,
                ]
            );
        }catch (\Exception $exception){
            return $exception;
        }

        return redirect()->route('admin.category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'tag' => 'required',
            'price' => 'required',
            'description' => 'required',
            'impact_factor' => 'required',
        ]);

        $logo = $request->file('logo');
        $slug = str_slug($request->name);
        $category = Category::find($id);
        if (isset($logo)){
            if (file_exists('images/category_logo/'.$category->logo)){
                unlink('images/category_logo/'.$category->logo);
            }
            $logoname = $slug.'-'.uniqid().'.'.$logo->getClientOriginalExtension();

            $logo->move('images/category_logo',$logoname);
        }else{
            $logoname = $category->logo;
        }

        $category->logo = $logoname;
        $category->name = $request->name;
        $category->tag = trim($request->tag);
        $category->price = trim($request->price);
        $category->category_color = $request->category_color;
        $category->description = $request->description;
        $category->impact_factor = $request->impact_factor;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;

        try{
            $category->save();
        }catch (\Exception $exception){
            return back()->with('danger', 'Something wrong');
        }

        return redirect()->route('admin.category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (file_exists('images/category_logo/'.$category->logo)){
            unlink('images/category_logo/'.$category->logo);
        }
        $category->delete();
        return back();
    }
}
