<div class="nb-2 nt-2">
    @auth
    
        <form action="{{ route('items.reviews.store',['item' => $item->id]) }}" method = "POST">
            @csrf 
            
            <input type="hidden" value="{{ $item->id }}" name="item_id" >
           
            <div class="form-group">
                <textarea type="text" name="content" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Review</button>
        </form>
    @else
        <a href="{{ route('login')}}">Sign-in</a> Item Reviewed!
    @endauth
    </div>
    <hr/>