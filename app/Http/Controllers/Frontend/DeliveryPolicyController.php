<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Delivery_policy;
use App\Models\Deliverypolicy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use App\Models\Author\Submit;
//use App\Models\Contact;
//use App\Models\UserFeedback;

class DeliveryPolicyController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $contact = Contact::all();
        $categories = Category::all();
        $delivery = Deliverypolicy::all();
        return view('website.pages.delivery_policy',compact('contact','categories','delivery'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'category_id' => 'required',
            'article_id' => 'required',
            'delivery_address' => 'required',
            'confirmed' => 'required',
            'accept' => 'required',
        ]);

        Delivery_policy::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'category_id' => $request->category_id,
                'article_id' => $request->article_id,
                'delivery_address' => $request->delivery_address,
                'confirmed' => $request->confirmed,
                'accept' => $request->accept,
                'status' => 1,
            ]
        );
        return redirect('/');
    }

    public function show(Delivery_policy $delivery_policy)
    {
        //
    }

    public function edit(Delivery_policy $delivery_policy)
    {
        //
    }

    public function update(Request $request, Delivery_policy $delivery_policy)
    {
        //
    }
    public function destroy(Delivery_policy $delivery_policy)
    {
        //
    }
}
