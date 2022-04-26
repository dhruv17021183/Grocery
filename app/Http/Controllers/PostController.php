<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItem;
use App\Models\Item;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('item.index',['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $validate = $request->validate();
        $item = new Item;
        $item->item_name = $request->input('name');
        $item->item_content = $request->input('content');
        $item->item_category = $request->input('category');
        $item->price = $request->input('price');
        $item->status = $request->input('status');
        $item->save();
       
        return redirect()->route('items.show',['item' => $item->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findorFail($id);
       
        return view('item.show',['item' => $item]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findorFail($id);
        return view('item.edit',['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::findorFail($id);
        $item->item_name = $request->input('name');
        $item->item_content = $request->input('content');
        $item->item_category = $request->input('category');
        $item->price = $request->input('price');
        $item->status = $request->input('status');
        $item->save();
        return redirect()->route('items.show',['item' =>$item->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        dd($id);
        // $item = Item::findorFail($id);
        // $item->delete();
        // return redirect()->route('items.index');
    }
}
