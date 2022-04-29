<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemCartController extends Controller
{
    public function usercart(Item $item,Request $request)
    {
        $cart = new Cart;
       
        $cart->item_id = $request->item;
        $cart['user_id'] = $request->user()->id;
        // dd($cart->item_id);
        
        
        $cart->save();

        return redirect()->route('items.index');  //we passing item to the show view
    }
    public function mycart(Item $item,Request $request)
    {

        // $users = DB::table('users')
        // ->join('contacts', 'users.id', '=', 'contacts.user_id')
        // ->join('orders', 'users.id', '=', 'orders.user_id')
        // ->select('users.*', 'contacts.phone', 'orders.price')
        // ->get();
        // $cart = DB::table('carts')->select('*')->first();
        // $cart = Cart::all()->toArray();
        // dump($cart);
        // dump($cart['user_id']);
        // die;
        // $users = DB::table('carts')
        //         ->select('item_id')->where('user_id','=',$cart->user_id)
        //         ->get();
        // return redirect()->route('users.cart', ['item' => $item->id]);
        // $users = Cart::all();
        // dd($users);
        // return view('cart.mycart', ['users' => $users]);
        $cart = new Cart;
        $userId = $request->user()->id;

        // $items = DB::table('carts')
        //         ->select('item_id')->where('user_id','=',$userId)
        //         ->get()->toJson();

        // dd($userId);
        // $cart['user_id'] = $request->user()->id;
        // dd($request->user()->id);
        $items = DB::table('carts')
                    ->join('items','carts.item_id','=','items.id')
                    ->where('carts.user_id',$userId)
                    ->select('items.*')
                    ->get();

        // dd($items);

        // dd($items[1]->item_name);

        return view('cart.mycart', ['items' => $items]);

    }
}
