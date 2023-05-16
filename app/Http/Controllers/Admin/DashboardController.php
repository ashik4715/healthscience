<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author\Submit;
use App\Models\Category;
use App\Models\Certification;
use App\Models\Editor;
use App\Models\Payagreement;
use App\Models\Paypal;
use App\Models\Stripe;
use App\Models\Subcategory;
use App\Models\UserFeedback;
use App\User;
use Session;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        // $coupon = strtoupper(str_random(7));
        // Session::put($coupon);
        // return $coupon;
        $submit = Submit::count();
        $approved = Submit::where('status', 1)->count();
        $pending = Submit::where('status', 0)->count();
        $reject = Submit::where('status', 2)->count();
        $paid = Submit::where('is_payment', 1)->count();
        $publish = Submit::where('publish', 1)->count();
        $paypal = Paypal::count();
        $stripe = Stripe::count();
        $category = Category::count();
        $certifications = Certification::count();
        $editors = Editor::count();
        $bank = Payagreement::where('payment','!=', null)->count();
        $subcategory = Subcategory::count();
        $author = User::where('role_id',2)->count();
        return view('admin.pages.index', compact('category','subcategory','userFeedback','author','submit','approved', 'pending','reject','certifications','paid','publish','paypal','stripe','bank','editors'));
    }
}
