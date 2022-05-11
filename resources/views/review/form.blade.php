<div class="nb-2 nt-2">
    @auth
    
        <form action="{{ route('items.reviews.store',['item' => $item->id]) }}" method = "POST">
            @csrf 
            
            <input type="hidden" value="{{ $item->id }}" name="item_id" >
           
            <div class="form-group">
                <textarea type="text" name="content" class="form-control"></textarea>
                <div class="form-group">
                    <label>Rating</label>
                        <select class="form-select" aria-label="Default select example" name="rate">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                        </select>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-block">Add Review</button>
        </form>
    @else
        <a href="{{ route('login')}}">Sign-in</a> Item Reviewed!
    @endauth
</div>
    <hr/>