<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

class ItemLikeController extends Controller
{
    public function il(Request $request)
    {
        DB::table('likes')->where('user_id',$request->user()->id)->where('item_id',$request->item_id)->delete();
        // dd('you likes items');
        $like = new Like;
        $like->user_id = $request->user()->id;
        $like->item_id = $request->item_id;
        $like->save();

        // $item = Item::findOrFail($request->item_id);
        // $item->likes()->attach([$like->id]);

        // dd(Item::with('likes')->get());
        return redirect()->back();
    }
}
