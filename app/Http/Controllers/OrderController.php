<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderdetails($id,Request $request)
    {
        
        return view('order.order',['item_id' => $id]);
    }
    public function store(Item $item,Request $request)
    {
        
        $request->validate([

            'qty' => 'required',
            'address' => 'required',
            'states' => 'required',
            'pincode' => 'required',
        ]);

       
        $order = new Order;
        
        $order->qty = $request->qty;
        $order->address = $request->address;
        $order->states = $request->states;
        $order->pincode = $request->pincode;
        $order['user_id'] = $request->user()->id;
        $order->item_id = $request->itemid;
        $order->save();
        // dd($request->all());
    }
}
