<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{

    public function index()
    {
        $faq = Faq::all();
        return view('admin.apc_faq.index', compact(['faq']));
    }

    public function create()
    {
        return view('admin.apc_faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'faq_question' => 'required',
            'faq_answer' => 'required',
        ]);

        Faq::create(
            [
                'faq_question' => $request->faq_question,
                'faq_answer' => $request->faq_answer,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.faq.index');
    }

    public function show(Faq $faq)
    {
        //
    }

    public function edit(Faq $faq)
    {
        return view('admin.apc_faq.edit', compact(['faq']));
    }


    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'faq_question' => 'required',
            'faq_answer' => 'required',
        ]);

        $faq->update(
            [
                'faq_question' => $request->faq_question,
                'faq_answer' => $request->faq_answer,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.faq.index');
    }

    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete about FAQ');
        }
        return redirect()->route('admin.faq.index');
    }
}
