<?php

namespace App\Http\Controllers\Admin;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
{

    public function index()
    {
        $term = Term::all();
        return view('admin.terms_conditions.index', compact(['term']));
    }

    public function create()
    {
        return view('admin.terms_conditions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'terms_title' => 'required',
            'terms_description' => 'required',
        ]);

        Term::create(
            [
                'terms_title' => $request->terms_title,
                'terms_description' => $request->terms_description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.terms.index');
    }

    public function show(Term $term)
    {
        //
    }

    public function edit(Term $term)
    {
        return view('admin.terms_conditions.edit', compact(['term']));
    }

    public function update(Request $request, Term $term)
    {
        $request->validate([
            'terms_title' => 'required',
            'terms_description' => 'required',
        ]);

        $term->update(
            [
                'terms_title' => $request->terms_title,
                'terms_description' => $request->terms_description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.terms.index');
    }

    public function destroy(Term $term)
    {
        try {
            $term->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete content Terms & Conditions');
        }
        return redirect()->route('admin.terms.index');
    }
}
