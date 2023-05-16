<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Sub_menu;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SubMenuController extends Controller
{

    public function index()
    {
        $sub_menus = DB::table('sub_menus as sm')
                            ->join('subcategories as sc','sc.id','=','sm.sub_category_id')
                            ->join('categories as c','c.id','=','sm.category_id')
                            ->orderByDesc('id')
                            ->select('sm.id as id','sm.title as title','c.tag as tag','sc.title as sctitle')
                            ->get();
        return view('admin.sub_menu.all', compact('sub_menus'));
    }


    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.sub_menu.new',compact('categories','subcategories'));
    }


    public function store(Request $request)
    {
//        return $request;
        $this->validate($request, [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        Sub_menu::create(
            [
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'title' => $request->title,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.sub-menu.index');
    }

    public function show(Sub_menu $sub_menu)
    {
        //
    }


    public function edit($id)
    {
        $sub_menu = Sub_menu::find($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.sub_menu.edit',compact('sub_menu','categories','subcategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $sub_menu = Sub_menu::find($id);

//        return $request;

        $sub_menu->update(
            [
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'title' => $request->title,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

//        return $sub_menu;

        return redirect()->route('admin.sub-menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sub_menu  $sub_menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_menu = Sub_menu::find($id);
        $sub_menu->delete();
        return back();
    }
}
