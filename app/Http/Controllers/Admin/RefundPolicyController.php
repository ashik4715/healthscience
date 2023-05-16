<?php

namespace App\Http\Controllers\Admin;

use App\Models\RefundPolicy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefundPolicyController extends Controller
{
    public function index()
    {
        $refundPolicy = RefundPolicy::all();
        return view('admin.refund_policy.index', compact(['refundPolicy']));
    }

    public function create()
    {
        return view('admin.refund_policy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'refund_title' => 'required',
            'refund_description' => 'required',
        ]);

        RefundPolicy::create(
            [
                'refund_title' => $request->refund_title,
                'refund_description' => $request->refund_description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.refundPolicy.index');
    }


    public function show(RefundPolicy $refundPolicy)
    {
        //
    }


    public function edit(RefundPolicy $refundPolicy)
    {
        return view('admin.refund_policy.edit', compact(['refundPolicy']));
    }


    public function update(Request $request, RefundPolicy $refundPolicy)
    {
        $request->validate([
            'refund_title' => 'required',
            'refund_description' => 'required',
        ]);

        $refundPolicy->update(
            [
                'refund_title' => $request->refund_title,
                'refund_description' => $request->refund_description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.refundPolicy.index');

    }

    public function destroy(RefundPolicy $refundPolicy)
    {
        try {
            $refundPolicy->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete content Refund Policy');
        }
        return redirect()->route('admin.refundPolicy.index');
    }
}

