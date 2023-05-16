<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArticleProcessingCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleProcessingChargeController extends Controller
{

    public function index()
    {
        $apc = ArticleProcessingCharge::all();
        return view('admin.apc.index', compact(['apc']));
    }

    public function create()
    {
        return view('admin.apc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'apc_title' => 'required',
            'apc_description' => 'required',
        ]);

        ArticleProcessingCharge::create(
            [
                'apc_title' => $request->apc_title,
                'apc_description' => $request->apc_description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );
        return redirect()->route('admin.apc.index');
    }

    public function show(ArticleProcessingCharge $apc_id)
    {
    }

    public function edit(ArticleProcessingCharge $apc)
    {
        return view('admin.apc.edit', compact(['apc']));
    }

    public function update(Request $request, ArticleProcessingCharge $apc)
    {
        $request->validate([
            'apc_title' => 'required',
            'apc_description' => 'required',
        ]);

        $apc->update(
            [
                'apc_title' => $request->apc_title,
                'apc_description' => $request->apc_description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.apc.index');
    }

    public function destroy(ArticleProcessingCharge $apc)
    {
        try {
            $apc->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete ArticleProcessingCharge ');
        }
        return redirect()->route('admin.apc.index');
    }
}
