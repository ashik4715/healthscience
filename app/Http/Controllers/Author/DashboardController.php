<?php

namespace App\Http\Controllers\Author;

use App\Models\Author\Submit;
use App\Models\Payagreement;
use App\Models\Paypal;
use App\Models\Stripe;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $submit = Submit::where('user_id', Auth::user()->id)->count();
        $approved = Submit::where('user_id', Auth::user()->id)->where('status', 1)->count();
        $paid = Submit::where('user_id', Auth::user()->id)->where('is_payment', 1)->where('auto_publish',0)->count();
        $auto_publish = Submit::where('user_id', Auth::user()->id)->where('auto_publish', 1)->count();
        $paypal = Paypal::where('user_id', Auth::user()->id)->count();
        $stripe = Stripe::where('user_id', Auth::user()->id)->count();
        $bank = DB::table('payagreements as pay')
            ->join('submits as sub','sub.id','=', 'pay.submit_id')
            ->join('users as u','u.id','=', 'sub.user_id')
            ->where('sub.user_id', Auth::user()->id)
            ->where('pay.payment', '!=', null)
            ->select('sub.user_id as id')
            ->count();
        $published = Submit::where('user_id', Auth::user()->id)->where('publish', 1)->count();
        $pending = Submit::where('user_id', Auth::user()->id)->where('status', 0)->count();
        $reject = Submit::where('user_id', Auth::user()->id)->where('status', 2)->count();
        return view('author.pages.dashboard', compact('submit','approved','pending', 'reject', 'published','paid','auto_publish','paypal','stripe','bank'));
    }

    public function submission_guideline(){

        return view('author.pages.submission_guideline');
    }
}
