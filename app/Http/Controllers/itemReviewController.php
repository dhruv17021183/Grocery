<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Item;
Use App\Models\User;

class itemReviewController extends Controller
{
   
    public function store(Item $item,Request $request)
    {
        
            $request->validate([
                'content' => 'required | min:10',
            ]);

            
            $review = new Review;
            $review->content = $request->content;
            $review->rating = $request->rate;
            $review->user_id = $request->user()->id;
            $review->item_id = $item->id;            
            $review->save();
    
            $request->session()->flash('status', 'Items Review Successfully');
    
            return redirect()->back();
    }

}
