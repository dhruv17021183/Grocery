<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PDF;

class AdminController extends Controller
{
    public function myOrders(Request $request)
    {
        $orders = DB::table('items')
            ->join('orders', 'orders.item_id', '=', 'items.id')
            ->where('items.user_id', $request->user()->id)
            ->where('orders.is_confirm', true)
            ->select('*')
            ->get();

        $date1 = Carbon::now()->format('Y-m-d');

        return view('admin.orders', ['orders' => $orders]);
    }
    public function cityorder(Request $request)
    {

        $city = DB::table('items')
            ->join('orders', 'orders.item_id', '=', 'items.id')
            ->where('items.user_id', $request->user()->id)
            ->where('orders.is_confirm', true)
            ->where('orders.city', $request->city)
            ->select('*')
            ->get();

        return view('admin.cityorder', ['orders' => $city]);
    }
    public function status(Request $request)
    {


        DB::table('orders')->where('user_id', $request->user_id)->where('item_id', $request->item_id)->update(['status' => $request->status]);

        // dd($request->item_id);
        $user = DB::table('users')->select('*')->where('id', $request->user_id)->get();

        $status = DB::table('orders')->where('user_id', $request->user_id)->where('item_id', $request->item_id)->get();


        // Mail::to($user[0]->email)->send(
        //     new OrderStatus($status[0]->status)
        // );

        if ($status[0]->status == "Delivered")
        {
          
            $items = DB::table('items')
            ->join('orders', 'orders.item_id', '=', 'items.id')
            ->where('orders.item_id',$request->item_id)
            ->select('*')
            ->get();

            // dd($items);

            $user = DB::table('users')
                    ->select('*')
                    ->where('id',$request->user_id)
                    ->get();

           

            $data = [

                'itemName' => $items[0]->item_name,
                'itemPrice' => $items[0]->price,
                'itemQty' => $items[0]->qty,
                'Address' => $items[0]->address,
                'city' => $items[0]->city,
                'state' => $items[0]->states,
                'pincode' => $items[0]->pincode,
                'orderDate' => $items[0]->created_at,
                'userFname' => $user[0]->firstname,
                'userLname' => $user[0]->lastname,
                'mobileNumber' => $user[0]->MobileNumber,
                'email' => $user[0]->email,
            ];

            // return view('pdf.mypdf',$data);
            $pdf = PDF::loadView('pdf.mypdf',$data);
           
            // dd($data);
            return $pdf->download('Bill.pdf');
           
        }
        else
        {
            dd('else');
        }

        return redirect()->back();
    }
    public function dashboard(Request $request)
    {
        $revenue = DB::table('items')
            ->join('orders', 'orders.item_id', '=', 'items.id')
            ->where('items.user_id', $request->user()->id)
            ->where('orders.is_confirm', true)
            ->select('*')
            ->get();

        $orders = DB::table('orders')->select('status')->where('status', '<>', 'Delivered')->get()->count();           // Pending orders

        return view('admin.dashboard', ['orders' => $revenue, 'orders' => $orders]);
    }
}
