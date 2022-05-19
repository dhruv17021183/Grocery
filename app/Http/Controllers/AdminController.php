<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatus;
use App\Mail\userDetails;
use App\Models\Item;
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
            ->where('orders.is_delivered',false)
            ->select('*')
            ->get();

        // dd($orders);

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

        $user = DB::table('users')->select('*')->where('id', $request->user_id)->get();

        $status = DB::table('orders')->where('user_id', $request->user_id)->where('item_id', $request->item_id)->get();

        // dd($status[0]->status);

        Mail::to($user[0]->email)->send(
            new OrderStatus($status[0]->status)
        );

        if ($status[0]->status == "Delivered")
        {
          
            DB::table('orders')->where('user_id', $request->user_id)->where('item_id', $request->item_id)->update(['is_delivered' => true]);   //if status is delivered than change in to the database 

            // dd($delivered);

            $items = DB::table('items')
            ->join('orders', 'orders.item_id', '=', 'items.id')
            ->where('orders.item_id',$request->item_id)
            ->where('orders.user_id',$request->user_id)
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

            // dd($data);
            // return view('pdf.mypdf',$data);
            // $path = "User_{$request->user_id}";
            $pdf = PDF::loadView('pdf.mypdf',$data);
            // $array = array('')
           
            // Mail::to($user[0]->email)->send(
            //     new userDetails($pdf)
            // );
            Mail::send('pdf.mypdf',$data,function($message) use ($data,$pdf){
                $message->to($data['email'])
                         ->attachData($pdf->output(),'Bill.pdf');
            });
            
            return $pdf->download('Bill.pdf');

        }
        // else
        // {
        //     dd('else');
        // }

        return redirect()->back();
    }
    public function dashboard(Request $request)
    {
        $revenues = DB::table('items')
            ->join('orders', 'orders.item_id', '=', 'items.id')
            ->where('items.user_id', $request->user()->id)
            ->where('orders.is_confirm', true)
            ->select('*')
            ->get();

    
        $total = 0;
        
        foreach($revenues as $revenue)
        {
            $total = $total + ($revenue->qty*$revenue->price);
        }

        $items = DB::table('items')->select('*')->where('user_id',$request->user()->id)->get()->count();
        
        
        $orders = DB::table('orders')->select('status')->where('status', '<>', 'Delivered')->get()->count(); 
        // dd($orders);          // Pending orders

        return view('admin.dashboard', ['total' => $total ,'items' => $items,'orders' => $orders]);
    }
}
