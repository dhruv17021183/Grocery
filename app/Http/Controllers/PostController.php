<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItem;
use App\Models\Item;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function mylikes(Request $request)
    {
        // dd($request->user()->id);
        // $item = new Item;
        $likes = DB::table('likes')->select('*')->where('user_id',$request->user()->id)->get()->pluck('item_id')->toArray();
        // dd($likes);
        $items = Item::findOrFail($likes);
        
        return view('users.mylikes',['items' => $items]);
    }

    public function removeLike(Request $request)
    {

        $likes = DB::table('likes')->where('item_id',$request->item_id)->where('user_id',$request->user()->id)->delete();
        return redirect()->back();
    }
    
    public function filterBypriceLow(Request $request)
    {
        if($request->filter == 'LH')
        {
            $itemsLW = Item::orderBy('price','ASC')->get();

            return view('item.filter',['items' =>  $itemsLW]);
        }
        else if($request->filter == 'HL')
        {
            $itemsHL = Item::orderBy('price', 'DESC')->get();

            return view('item.filter',['items' =>  $itemsHL]);
        }
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $id = DB::table('items')
                      ->select('*')
                      ->where('item_name','like',"%$request->search%")
                      ->orWhere('item_category','like',"%$request->search%")
                      ->pluck('id')
                      ->toArray();

        $search = $request->search;
        // dd($search);
        $item = Item::findOrFail($id);

        return view('search.show',['items' => $item,'search' => $search]);
    }

    public function index()
    {
        // $items = Item::withCount('likes')->get();
        $items = Item::latest()->withCount('likes')->withCount('reviews')->get(); 
        // dd($items);
        // foreach ($items as $item)
        // { 
        //     dump($item->likes_count); 
        // }
        // die;
        // dd($items);
        
        return view('item.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-item'))         //users instance will pass automatically by laravel
        {
            abort(403, "Unauthorized Action");
        };

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
        $request->validate([
            'name' => 'required|min:2|max:20',
            'content' => 'required',
            'category' => 'required',
            'price' => 'required',
            'status' => 'required',

        ]);

        $item = new Item;
        $item->item_name = $request->input('name');
        $item->item_content = $request->input('content');
        $item->item_category = $request->input('category');
        $item->price = $request->input('price');
        $item->status = $request->input('status');
        $item['user_id'] = $request->user()->id;
        $item->save();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            $item->image()->save(
                Image::make(['path' => $path])
            );
        }

        $request->session()->flash('status', 'Items Created Successfully');

        return redirect()->route('items.show', ['item' => $item->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $item = Item::findorFail($id);
        
        $is_confirm = DB::table('orders')->select('*')->where('user_id',$request->user()->id)->where('item_id',$item->id)->get();
   
        if(!isset($is_confirm[0]->is_confirm))     //when receives blank object
        {
            $success = false;
        }
        else
        {
            if(isset($is_confirm[0]->is_confirm) && $is_confirm[0]->status == 'Delivered')
            {
                $success = true;
            }
            else
            {
                $success = false;
            }
        }

        return view(
            'item.show',
            [
                'item' => $item,
                'confirm' => $success,
            ]
                            
        );                          //we passing item to the show view
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

        // if(Gate::denies('update-post',$item))         //users instance will pass automatically by laravel
        // {
        //     abort(403,"Unauthorized Action");
        // }; 
        $this->authorize('items.update', $item);

        return view('item.edit', ['item' => $item]);
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
        // if(Gate::denies('update-post',$item))         //users instance will pass automatically by laravel
        // {
        //     abort(403,"Unauthorized Action");
        // }; 
        $this->authorize('items.update', $item);

        $item->item_name = $request->input('name');
        $item->item_content = $request->input('content');
        $item->item_category = $request->input('category');
        $item->price = $request->input('price');
        $item->status = $request->input('status');
        // $item['user_id'] = $request->user()->id;
        $item->save();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($item->image) {
                Storage::delete($item->image->path);
                // dd($item->image->path);
                $item->image->path = $path;
                $item->image->save();
            } else {
                $item->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }

        return redirect()->route('items.show', ['item' => $item->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = Item::findorFail($id);
        // if(Gate::denies('delete-post',$item))         //users instance will pass automatically by laravel
        // {
        //     abort(403,"Unauthorized Action");
        // }; 
        $this->authorize('items.delete', $item);

        $item->delete();
        return redirect()->route('items.index');
    }
}
