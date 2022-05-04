@include('layouts')
    @foreach ($items as $item)
        
        <div class="card box" style="width: 15rem;">
            <img src="{{ $item->image ? $item->image->url() : '' }}" class="card-img-top" alt="...">
            {{-- <img src="{{ Storage::url($item->path) }}" class="card-img-top" alt="..."> --}}

            <div class="card-body">
                <h5 class="card-title"><a href="{{ route('items.show', ['item' => $item->id]) }}" class="text-decoration-none">{{ $item->item_name }}</a></h5>
                <p class="card-text">{{ $item->item_content }}</p>
                <p class="card-text">{{ $item->item_category }}</p>
            </div>
            <ul class="list-group">
                <li class="list-group-item">1 Kg - Rs {{ $item->price }}</li>
                <li class="list-group-item">{{ $item->status }}</li>
           
                    <form method="POST" action="{{ route('remove.cart',[$item->id] )}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2">Remove Cart</button>
                    </form>
                
                    
               
                    <a href="{{ route('on',[$item->id]) }}" class="btn btn-success">
                        BUY NOW
                    </a>   
            </ul>
            
        </div>
        
    @endforeach

