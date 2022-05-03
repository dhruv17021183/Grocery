@include('layouts')

<div class="container row row-cols-1 row-cols-md-2 g-4">
    @foreach($category as $item)
          <div class="card box" style="width: 15rem;">
            <img src="{{ $item->image ? $item->image->url() : '' }}" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('items.show', ['item' => $item->id]) }}" class="text-decoration-none">{{ $item->item_name }}</a></h5>
                        <p class="card-text">{{ $item->item_content }}</p>
                        <p class="card-text">{{ $item->item_category }}</p>
                </div>
                <ul class="list-group">
                        <li class="list-group-item">1 Kg - Rs {{ $item->price }}</li>
                        <li class="list-group-item">{{ $item->status }}</li>
                        
      
                            <input type="hidden" value="{{ $item->id }}" name="item_id"/>
                            <a href="{{ route('items.cart', ['item' => $item->id]) }}" class="btn btn-primary mt-2">
                                Add To Cart
                            </a>
                      

                        @can('update',$item)
                            <a href="{{ route('items.edit', ['item' => $item->id]) }}" class="btn btn-primary mt-2">
                                Edit
                            </a>
                        @endcan
                        
                        @can('delete',$item)
                            <form method="POST" action="{{ route('items.destroy',['item' => $item->id] )}}">
                        
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2">Delete</button>
                            </form>
                        @endcan
                </ul>
          </div>
    @endforeach
</div>
