<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe;
use Session;

class StripeController extends Controller
{
    public function Pdebit(Request $request)
    {
        // dd($request->all());
        // $stripe_obj = new Stripe();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // $stripe = $stripe_obj->setApiKey(env('STRIPE_SECRET'));
    	$data = Stripe\Charge::create([
    			"amount"=>200*100,
    			"currency"=>"usd",
    			"source"=>$request->stripeToken,
    			"description"=>"Test payment from expert rohila 2"
    	]);
        echo "<pre>"; print_r($data); die();

    	Session::flash("success","Payment successfully!");

    	return back();
    }
    
}
