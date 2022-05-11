<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Item;
Use App\Models\User;
use Illuminate\Support\Facades\DB;

class itemReviewController extends Controller
{
   
    public function store(Item $item,Request $request)
    {
        // dump($request->user()->id);
        // dump($item->id);
        // die;

        // $success = DB::table('orders')->select('is_confirm')->where('user_id',$request->user()->id)->where('item_id',$item->id)->get();
        // dd($success[0]->is_confirm);


            $request->validate([
                'content' => 'required | min:10',
            ]);

            
            $review = new Review;
            $review->content = $request->content;
            $review->rating = $request->rate;
            $review->user_id = $request->user()->id;
            $review->item_id = $item->id;            
            $review->save();
    
            // $request->session()->flash('status', 'Items Review Successfully');
            return redirect()->back();
    }

}
