<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe;
use Session;

class StripeController extends Controller
{
    public function Pdebit(Request $request)
    {
        // dd('hello');
        // dd();
        // $stripe_obj = new Stripe();
        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // $stripe = $stripe_obj->setApiKey(env('STRIPE_SECRET'));
    	// Stripe\Charge::create([
    	// 		"amount"=>200*100,
    	// 		"currency"=>"usd",
    	// 		"source"=>$request->stripeToken,
    	// 		"description"=>"Test payment from expert rohila 2"
    	// ]);
        // echo "<pre>"; print_r($data); die();

    	// Session::flash("success","Payment successfully!");
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        		
		$amount = $request->price;
		$amount *= 100;
        $amount = (int) $amount;
        // dd($request->user()->id);
        // dd($amount);
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'INR',
			'description' => 'Payment From User',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;
        // dd($intent);
    	Session::flash("success","Payment successfully!");


		return view('stripe.debit',compact('intent'));


    	// return back();
    }
    public function afterPayment()
    {
        echo 'Payment Has been Received';
    }
    
}
