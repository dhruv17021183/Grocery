<?php

namespace App\Http\Controllers;

use App\Jobs\ReviewItem;
use App\Mail\Bill;
use App\Mail\orderPurchase;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->only(['orderdetails', 'store', 'orderConfirm']);
    }

    public function orderdetails($id,Request $request)
    {
        $item = Item::findOrFail($id);
        // dd($item);
        return view('order.order',['item_id' => $id,'item' => $item]);
    }

    public function store(Request $request)
    {
        
        DB::table('orders')->where('user_id',$request->user()->id)->where('item_id',$request->itemid)->delete();
        // dd($delete);
        $request->validate([

            'qty' => 'required',
            'address' => 'required',
            'states' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'MN' => 'required',
        ]);

        // $id = DB::table('items')->select('*')->where('id','=',$request->itemid)->get()->pluck('id');

        // $item = new Item;
        // $itemId = Item::findOrFail($id);
        // dd($itemId);
        $order = new Order;
        
        $order->qty = $request->qty;
        $order->address = $request->address;
        $order->states = $request->states;
        $order->city = $request->city;
        $order->MobileN = $request->MN;
        $order->pincode = $request->pincode;
        $order['user_id'] = $request->user()->id;
        $order->item_id = $request->itemid;
        $order->save();

        $items = DB::table('items')
        ->join('orders','orders.item_id','=','items.id')
        ->join('images','images.imageable_id','=','items.id')
        ->where('orders.item_id','=',$request->itemid)
        ->where('orders.user_id',$request->user()->id)
        ->distinct()
        ->select('*')
        ->get();

        // dd($items);

        $itemsC = DB::table('items')->select('price')->where('id',$request->itemid)->get()->pluck('price')->toArray();
        $quantity = DB::table('orders')->select('qty')->where('item_id',$request->itemid)->where('user_id',$request->user()->id)->get();

        // dd($quantity);
    
        // if($request->promo === "FIRST50")
        // {
        //     $price = $itemsC[0] * $quantity[0] * 0.5;
        //     // dd($price);
        // }
        // else
        // {
        //     $price = $itemsC[0] * $quantity[0];
        //     // dd($price);
        // }
        // dd($items);
        return view('order.confirm',['item' => $items]);
    
    }
    // public function orderConfirm()
    // {
    //     return view('order.confirm');
    // }
    public function orderConfirm(Request $request)
    {
        
        DB::table('orders')->where('user_id',$request->user()->id)->where('item_id',$request->itemid)->update(['is_confirm'=>true]);

        $orderId = DB::table('orders')->select('*')
                                        ->where('user_id',$request->user()->id)
                                        ->where('item_id',$request->itemid)
                                        ->where('is_confirm',true)->get();

                                        
        // $user = User::findOrFail($request->user()->id)->get();
        $user = DB::table('users')->select('email')->where('id',$request->user()->id)->get();

        // dd($orderId[0]->item_id);
        $items = DB::table('items')
        ->join('orders','orders.item_id','=','items.id')
        ->join('images','images.imageable_id','=','items.id')
        ->where('orders.item_id','=',$request->itemid)
        ->where('orders.user_id',$request->user()->id)
        ->distinct()
        ->select('*')
        ->get();

        $price = $items[0]->price*$items[0]->qty;
        

        // Mail::to($user[0]->email)->send(
        //     new orderPurchase($orderId)
        // );
        // Mail::to($user[0]->email)->send(
        //     new Bill($items)
        // );
        // $email = $user[0]->email;
        // dd($orderId);
        // ReviewItem::dispatch($orderId,$email);
        // dd($request->all());
        if($request->payment == 'Debit')
        {
            // dd($price);
            return view('stripe.debit',['price' => $price]);
            // return redirect()->route('debit');
        }
        else
        {
            return view('order.place',['userorder' => $orderId]);
        }
    }

    // public function reedem(Request $request)
    // {
    //     $items = DB::table('items')->select('price')->where('id',$request->itemid)->get()->pluck('price')->toArray();
    //     $quantity = DB::table('orders')->select('qty')->where('item_id',$request->itemid)->get()->pluck('qty')->toArray();

    //     // dd($quantity);
    
    //     if($request->promo === "FIRST50")
    //     {
    //         $price = $items[0] * $quantity[0] * 0.5;
    //         // dd($price);
    //     }
    //     else
    //     {
    //         $price = $items[0] * $quantity[0];
    //         // dd($price);
    //     }
    //     // dd($price);
    //     return view('order.confirm',['price' => $price]);
    // }
    public function UsersOrder(Request $request)
    {
        // $user = User::find($request->user()->id);
        // $orders = $user->orders;
        
        $myorders = DB::table('orders')->select('*')->where('user_id',$request->user()->id)->where('is_confirm',true)->get();

        // dd($myorders);

        return view('users.myorder',['orders' => $myorders]);
        
    }
    
    // public function generatePDF(Request $request)
    // {
    //     return view('pdf.mypdf');
    // }
  
}
