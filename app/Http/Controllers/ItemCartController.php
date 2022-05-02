<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemCartController extends Controller
{
    public function usercart(Item $item,Request $request)
    {
        $cart = new Cart;
        // $itemid = $request->item;
        
        // $image = Image::findOrFail($itemid)->get();
        // dd($image);
        
        $cart->item_id = $request->item;
        $cart['user_id'] = $request->user()->id;
        // dd($cart->item_id);
        
        $cart->save();

        return redirect()->route('items.index');  //we passing item to the show view
    }
    public function mycart(Item $item,Request $request)
    {

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
        return view('cart.mycart', ['items' => $items]);

    }
    public function removeCart($id)
    {
        $cart = DB::table('carts')->where('item_id', $id)->delete();
        
        return redirect()->back();

    }
}
