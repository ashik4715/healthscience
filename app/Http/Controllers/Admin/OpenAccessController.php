<?php

namespace App\Http\Controllers\Admin;

use App\Models\OpenAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpenAccessController extends Controller
{

    public function index()
    {
        $openAccess = OpenAccess::all();
        return view('admin.open_access_policy.index', compact(['openAccess']));
    }

    public function create()
    {
        return view('admin.open_access_policy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
        ]);

        OpenAccess::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.openAccess.index');
    }


    public function show(OpenAccess $openAccess)
    {
        //
    }

    public function edit(OpenAccess $openAccess)
    {
        return view('admin.open_access_policy.edit', compact(['openAccess']));
    }

    public function update(Request $request, OpenAccess $openAccess)
    {
        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
        ]);

        $openAccess->update(
            [
                'title' => $request->title,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.openAccess.index');
    }

    public function destroy(OpenAccess $openAccess)
    {
        try {
            $openAccess->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete content Open Access Policy');
        }
        return redirect()->route('admin.openAccess.index');
    }
}
