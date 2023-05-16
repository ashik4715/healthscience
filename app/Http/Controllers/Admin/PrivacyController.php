<?php

namespace App\Http\Controllers\Admin;

use App\Models\Privacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    public function index()
    {
        $privacy = Privacy::all();
        return view('admin.privacy_policy.index', compact(['privacy']));
    }

    public function create()
    {
        return view('admin.privacy_policy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'privacy_title' => 'required',
            'privacy_description' => 'required',
        ]);

        Privacy::create(
            [
                'privacy_title' => $request->privacy_title,
                'privacy_description' => $request->privacy_description,

                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.privacy.index');
    }
    public function show(Privacy $privacy)
    {
        //
    }

    public function edit(Privacy $privacy)
    {
        return view('admin.privacy_policy.edit', compact(['privacy']));
    }

    public function update(Request $request, Privacy $privacy)
    {
        $request->validate([
            'privacy_title' => 'required',
            'privacy_description' => 'required',
        ]);

        $privacy->update(
            [
                'privacy_title' => $request->privacy_title,
                'privacy_description' => $request->privacy_description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.privacy.index');
    }

    public function destroy(Privacy $privacy)
    {
        try {
            $privacy->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete content Privacy Policy');
        }
        return redirect()->route('admin.privacy.index');
    }
}
