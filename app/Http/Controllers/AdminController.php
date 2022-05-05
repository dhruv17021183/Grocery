<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function myOrders(Request $request)
    {
        $orders = DB::table('items')
                            ->join('orders','orders.item_id','=','items.id')
                            ->where('items.user_id',$request->user()->id)
                            ->where('orders.is_confirm',true)
                            ->select('*')
                            ->get();
        // dd($orders);

        return view('admin.orders',['orders' => $orders]);
    }
    public function status(Request $request)
    {

        DB::table('orders')->where('user_id',$request->user_id)->where('item_id',$request->item_id)->update(['status' => $request->status]);
        return redirect()->back();

    }
    public function dashboard(Request $request)
    {
        $revenue = DB::table('items')
                            ->join('orders','orders.item_id','=','items.id')
                            ->where('items.user_id',$request->user()->id)
                            ->where('orders.is_confirm',true)
                            ->select('*')
                            ->get();
                            
        $orders = DB::table('orders')->select('status')->where('status','<>','Delivered')->get()->count();           // Pending orders
        
        
        // dd($orders);
        // dd($orders);
        return view('admin.dashboard',['orders' => $revenue,'orders' => $orders]);
    }
}
