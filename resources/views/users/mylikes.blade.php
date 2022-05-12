@include('layouts')

@foreach($items as $item)
          <div class="card box" style="width: 15rem;">
             
               <img src="{{ $item->image ? $item->image->url() : '' }}" class="card-img-top" alt="...">
               <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('items.show', ['item' => $item->id]) }}" class="text-decoration-none">{{ $item->item_name }}</a></h5>
                    <p class="card-text">{{ $item->item_content }}</p>
                    <p class="card-text">{{ $item->item_category }}</p>
                    <div class="border border-5 rounded-pill"><p class="card-text">{{ $item->likes_count +30 }} <i class="fa fa-heart" aria-hidden="true"></i> Likes </p></div>
               </div>
               <ul class="list-group">
                    <li class="list-group-item">1 Kg - Rs {{ $item->price }}</li>
                    <li class="list-group-item">{{ $item->status }}</li>
                    <a href="{{ route('items.cart', ['item' => $item->id]) }}" class="btn btn-primary mt-2">
                        Add To Cart
                    </a>

                    <form action= {{ route('removeLike') }} method="get" enctype="multipart/form-data">
                        
                        <input type="hidden" name="item_id" value={{ $item->id }}>
                        <button type="submit" class="btn btn-danger">Remove</button>
                        
                    </form>
               </ul> 
          </div>
@endforeach