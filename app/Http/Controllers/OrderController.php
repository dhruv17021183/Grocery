<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // $id = DB::table('items')->select('*')->where('id','=',$request->itemid)->get()->pluck('id');

        // $item = new Item;
        // $itemId = Item::findOrFail($id);
        // dd($itemId);
        $order = new Order;
        
        $order->qty = $request->qty;
        $order->address = $request->address;
        $order->states = $request->states;
        $order->pincode = $request->pincode;
        $order['user_id'] = $request->user()->id;
        $order->item_id = $request->itemid;
        $order->save();

        $items = DB::table('items')
        ->join('orders','orders.item_id','=','items.id')
        ->join('images','images.imageable_id','=','items.id')
        ->where('orders.item_id','=',$request->itemid)
        ->distinct()
        ->select('*')
        ->get();

        // dd($items);
        return view('order.confirm',['itemId' => $items]);
    
    }
    // public function orderConfirm()
    // {
    //     return view('order.confirm');
    // }
    public function orderConfirm()
    {

    }
  
}
