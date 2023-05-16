<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditorController extends Controller
{

    public function index()
    {
        $editors = Editor::orderBy('id', 'DESC')->get();
        return view('admin.editor.index',compact('editors'));
    }

    public function create()
    {
      $categories = Category::all();
      return view('admin.editor.create',compact('categories'));

    }

    public function store(Request $request)
    {


      $this->validate($request, [
              'image' => 'required|mimes:jpeg,jpg,png',
              'name' => 'required',
              'email' => 'required',
              'editor_position' => 'required',
              'category_id' => 'required',
      ]);

      $image = $request->file('image');
      $slug = str_slug($request->name);
      if (isset($image)){
        $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

        if (!file_exists('images/editor_panel_profile')){
          // mkdir('images/editor_panel_profile',0777, true);
        }
        $image->move('images/editor_panel_profile',$imagename);
      }

      $editor = new Editor();
      $editor->name = $request->name;
      $editor->email = $request->email;
      $editor->editor_position = $request->editor_position;
      $editor->category_id = $request->category_id;
      $editor->web = $request->web;
      $editor->image = $imagename;
      $editor->message = $request->message;
      $editor->description = $request->description;
      $editor->meta_title = $request->meta_title;
      $editor->meta_description = $request->meta_description;

//      dd($editor);
      try{
        $editor->save();

      }catch (\Exception $exception){
        return back()->with('danger', 'Something wrong');
      }

      return redirect()->route('admin.editor-panel.index');
    }

    public function show(Editor $editor)
    {
        //
    }

    public function edit($id)
    {
//      dd($id);
      $editor = Editor::find($id);
      $categories = Category::all();
      return view('admin.editor.edit',compact('categories','editor'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
//              'image' => 'required|mimes:jpeg,jpg,png',
              'name' => 'required',
              'email' => 'required',
              'editor_position' => 'required',
              'category_id' => 'required',
      ]);

      $image = $request->file('image');
      $slug = str_slug($request->name);
      $editor = Editor::find($id);
      if (isset($image)){
        if (file_exists('images/editor_panel_profile/'.$editor->image)){
          unlink('images/editor_panel_profile/'.$editor->image);
        }

        $imagename = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

        if (!file_exists('images/editor_panel_profile')){
          mkdir('images/editor_panel_profile',0777, true);
        }
        $image->move('images/editor_panel_profile',$imagename);
        $editor->image = $imagename;
      }

      $editor->name = $request->name;
      $editor->email = $request->email;
      $editor->editor_position = $request->editor_position;
      $editor->category_id = $request->category_id;
      $editor->web = $request->web;
      $editor->message = $request->message;
      $editor->description = $request->description;
      $editor->meta_title = $request->meta_title;
      $editor->meta_description = $request->meta_description;

//      dd($editor);
      try{
        $editor->save();

      }catch (\Exception $exception){
        return back()->with('danger', 'Something wrong');
      }

      return redirect()->route('admin.editor-panel.index');
    }

    public function destroy($id)
    {
      $editor = Editor::find($id);
      if (file_exists('images/editor_panel_profile/'.$editor->image)){
        unlink('images/editor_panel_profile/'.$editor->image);
      }
      $editor->delete();
      return back();
    }
}
