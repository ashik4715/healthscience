<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::orderByDesc('id')->get();
        return view('admin.subcategory.all', compact('subcategories'));
    }

    public function create()
    {
        return view('admin.subcategory.new');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
           'hero_title' => 'required',
           'title' => 'required',
           'description' => 'required',
        ]);

        Subcategory::create(
            [
                'hero_title' => $request->hero_title,
                'title' => $request->title,
                'title_slug' => str_slug($request->title),
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.sub-category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $subcategory = Subcategory::find($id);
        return view('admin.subcategory.edit', compact('subcategory'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hero_title' => 'nullable',
            'title' => 'required',
            'description' => 'required',
        ]);

        $subcategory = Subcategory::find($id);

        $subcategory->update(
            [
                'hero_title' => $request->hero_title,
                'title' => $request->title,
                'title_slug' => str_slug($request->title),
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.sub-category.index');
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return back();

    }
}
