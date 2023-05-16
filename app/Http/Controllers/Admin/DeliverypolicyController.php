<?php

namespace App\Http\Controllers\Admin;

use App\Models\Delivery_policy;
use App\Models\Deliverypolicy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliverypolicyController extends Controller
{

    public function index()
    {
        $delivery = Deliverypolicy::orderBy('id', "DESC")->get();
        return view('admin.delivery.index', compact('delivery'));
    }

    public function indexweb()
    {
        $delivery_policys = Delivery_policy::all();
        return view('admin.delivery_policy.index', compact('delivery_policys'));
    }

    public function create()
    {
        return view('admin.delivery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        Deliverypolicy::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
            ]
        );

        return redirect()->route('admin.delivery-policy.index');
    }

    public function show($id)
    {
        $delivery_policy = Delivery_policy::find($id);
        return view('admin.delivery_policy.show', compact('delivery_policy'));
    }

    public function edit($id)
    {
        $delivery = Deliverypolicy::find($id);
        return view('admin.delivery.edit', compact('delivery'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $deliverypolicy = Deliverypolicy::find($id);
        $deliverypolicy->update(
            [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
            ]
        );

        return redirect()->route('admin.delivery-policy.index');
    }

    public function destroy($id)
    {
        try {
            $deliverypolicy = Deliverypolicy::find($id);
            $deliverypolicy->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete Delivery Policy');
        }
        return redirect()->route('admin.delivery-policy.index');
    }
}