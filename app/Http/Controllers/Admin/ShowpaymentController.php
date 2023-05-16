<?php

namespace App\Http\Controllers\Admin;

use App\Mail\BankPayment;
use App\Mail\Published;
use App\Mail\Unpublished;
use App\Models\Payagreement;
use App\Models\Paypal;
use App\Models\Stripe;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShowpaymentController extends Controller
{

    public function bankpayment(){
        $payment = DB::table('submits as sub')
                        ->join('users as u', 'u.id', '=', 'sub.user_id')
                        ->join('payagreements as pay', 'pay.submit_id', '=', 'sub.id')
                        ->where('pay.payment', '!=', null)
                        ->select('pay.*','sub.paper_id as paper_id', 'u.firstname as name','u.email as email')
                        ->get();
        return view('admin.showpayment.bank', compact('payment'));
    }

    public function bankpaymentok($id){
        $payment = DB::table('submits as sub')
            ->join('users as u', 'u.id', '=', 'sub.user_id')
            ->join('payagreements as pay', 'pay.submit_id', '=', 'sub.id')
            ->where('pay.payment', '!=', null)
            ->where('pay.id', '=', $id)
            ->select('pay.*','sub.paper_id as paper_id', 'u.firstname as name','u.email as email')
            ->first();
        DB::table('payagreements')->where('id', $id)->update(['is_done' => 1]);
        DB::table('submits')->where('id', $payment->submit_id)->update(['is_payment' => 1]);
        Mail::to($payment->email)->queue(new BankPayment($payment));
        return back();
    }

    public function bankpaymentnotok($id){
        $payagreement = Payagreement::find($id);
        DB::table('payagreements')->where('id', $id)->update(['is_done' => 0]);
        DB::table('submits')->where('id', $payagreement->submit_id)->update(['is_payment' => 0]);
        return back();
    }

    public function bankpublish($id){
        $submit = DB::table('submits as sub')
                        ->join('users as u', 'u.id', '=', 'sub.user_id')
                        ->join('categories as cat', 'cat.id', '=', 'sub.journal_id')
                        ->join('payagreements as pay', 'pay.submit_id', '=', 'sub.id')
                        ->select('sub.paper_id as paper_id','sub.ptitle as ptitle','sub.user_id as user_id','cat.name as catName')
                        ->where('pay.submit_id', $id)
                        ->first();
        $user = User::find($submit->user_id);
        Mail::to($user->email)->queue(new Published($submit, $user));
        DB::table('submits')->where('id',$id)->update(['publish' => 1]);
        DB::table('payagreements')->where('submit_id',$id)->update(['status' => 1]);
        return back();
    }
    public function bankunpublish($id){
        $submit = DB::table('submits as sub')
                        ->join('users as u', 'u.id', '=', 'sub.user_id')
                        ->join('categories as cat', 'cat.id', '=', 'sub.journal_id')
                        ->join('payagreements as pay', 'pay.submit_id', '=', 'sub.id')
                        ->select('sub.paper_id as paper_id','sub.ptitle as ptitle','sub.user_id as user_id','cat.name as catName')
                        ->where('pay.submit_id', $id)
                        ->first();
        $user = User::find($submit->user_id);
        Mail::to($user->email)->queue(new Unpublished($submit, $user));
        DB::table('submits')->where('id',$id)->update(['publish' => 0]);
        DB::table('payagreements')->where('submit_id',$id)->update(['status' => 0]);
        return back();
    }
    public function stripepayment(){
        $stripes = Stripe::orderBy('id', 'DESC')->get();
        return view('admin.showpayment.stripe', compact('stripes'));
    }
    public function spublish($id){
        $stripe = Stripe::find($id);
        $user = User::find($stripe->user_id);
        $submit = DB::table('submits as sub')
            ->join('categories as cat', 'cat.id', '=', 'sub.journal_id')
            ->where('sub.paper_id', $stripe->paper_id)
            ->select('sub.paper_id as paper_id','sub.ptitle as ptitle', 'cat.name as catName')
            ->first();
        Mail::to($user->email)->queue(new Published($submit, $user));
        DB::table('submits')->where('paper_id',$stripe->paper_id)->update(['publish' => 1]);
        DB::table('stripes')->where('id',$id)->update(['publish' => 1]);
        return back();
    }
    public function sunpublish($id){
        $stripe = Stripe::find($id);
        $user = User::find($stripe->user_id);
        $submit = DB::table('submits as sub')
            ->join('categories as cat', 'cat.id', '=', 'sub.journal_id')
            ->where('sub.paper_id', $stripe->paper_id)
            ->select('sub.paper_id as paper_id','sub.ptitle as ptitle', 'cat.name as catName')
            ->first();
        Mail::to($user->email)->queue(new Unpublished($submit, $user));
        DB::table('stripes')->where('id',$id)->update(['publish' => 0]);
        DB::table('submits')->where('paper_id',$stripe->paper_id)->update(['publish' => 0]);
        return back();
    }
    public function showpayment(){
        $payment = Paypal::orderBy('id','DESC')->get();
        return view('admin.showpayment.paypal', compact('payment'));
    }

    public function paypalpublish($id){
        // return $id;
        $paypal = Paypal::find($id);
        $user = User::find($paypal->user_id);
        $submit = DB::table('submits as sub')
            ->join('categories as cat', 'cat.id', '=', 'sub.journal_id')
            ->where('sub.paper_id', $paypal->paper_id)
            ->select('sub.paper_id as paper_id','sub.ptitle as ptitle', 'cat.name as catName')
            ->first();
        Mail::to($user->email)->queue(new Published($submit, $user));
        DB::table('paypals')->where('id',$id)->update(['publish' => 1]);
        DB::table('submits')->where('paper_id',$paypal->paper_id)->update(['publish' => 1]);
        return back();
    }
    public function paypalunpublish($id){
        $paypal = Paypal::find($id);
        $user = User::find($paypal->user_id);
        $submit = DB::table('submits as sub')
            ->join('categories as cat', 'cat.id', '=', 'sub.journal_id')
            ->where('sub.paper_id', $paypal->paper_id)
            ->select('sub.paper_id as paper_id','sub.ptitle as ptitle', 'cat.name as catName')
            ->first();
        Mail::to($user->email)->queue(new Unpublished($submit, $user));
        DB::table('paypals')->where('id',$id)->update(['publish' => 0]);
        DB::table('submits')->where('paper_id',$paypal->paper_id)->update(['publish' => 0]);
        return back();
    }

}
