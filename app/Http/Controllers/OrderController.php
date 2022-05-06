<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return view('order.order',['item_id' => $id]);
    }

    public function store(Request $request)
    {
        
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
    public function orderConfirm(Request $request)
    {
        DB::table('orders')->where('user_id',$request->user()->id)->where('item_id',$request->itemid)->update(['is_confirm'=>true]);

        $orderId = DB::table('orders')->select('*')
                                        ->where('user_id',$request->user()->id)
                                        ->where('item_id',$request->itemid)
                                        ->where('is_confirm',true)->get();

        return view('order.place',['userorder' => $orderId]);
    }
    public function reedem(Request $request)
    {
        $items = DB::table('items')->select('price')->where('id',$request->item_id)->get()->pluck('price')->toArray();
        $quantity = DB::table('orders')->select('qty')->where('item_id',$request->item_id)->get()->pluck('qty')->toArray();

        if($request->promo === "FIRST50")
        {
            $price = $items[0] * $quantity[0] * 0.5;
        }
        else
        {
            $price = $items[0] * $quantity[0];
            dd($price);
        }
        dd($price);

        // return view('order.promo');
    }
    public function UsersOrder(Request $request)
    {
        // $user = User::find($request->user()->id);
        // $orders = $user->orders;
        
        $myorders = DB::table('orders')->select('*')->where('user_id',$request->user()->id)->where('is_confirm',true)->get();

        // dd($myorders);

        return view('users.myorder',['orders' => $myorders]);
        
    }
    public function generatePDF(Request $request)
    {
        // dd($request->user()->id);

        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        //     'date' => date('m/d/Y')
        // ];
          
        // $pdf = PDF::loadView('pdf.mypdf', $data);
    
        
        // return $pdf->download('Your_Bill.pdf');
        // foreach ($users as $user) 
        // {
        //     //$product->skus is a collection of Sku models
        //     dd( $user->orders );
        // }
        // return view('pdf.mypdf',['users' => $users]);
    }
  
}
