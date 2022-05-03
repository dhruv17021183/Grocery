<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryWiseController extends Controller
{
    public function categorywise($category)
    {
        $categoryWise = DB::table('items')->select('id')->where('item_category','=',$category)->get()->pluck('id')->toArray();
        // dd($categoryWise);
        $item = Item::findOrFail($categoryWise);
        // dd($item);
        return view('category.category',['category' => $item]);
    }
}
