@include('layouts')
    {{-- @foreach ($items as $item)
        
        <div class="card box" style="width: 15rem;">
            <img src="{{ $item->image ? $item->image->url() : '' }}" class="card-img-top" alt="...">
            {{-- <img src="{{ Storage::url($item->path) }}" class="card-img-top" alt="..."> 

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
        
    @endforeach --}}

    <section class="py-2">
        <div class="container px-4 px-lg-5">
             <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach($items as $item)
        <div class="col mb-5">
            <div class="card h-100">
                 {{-- Sale Badge --}}
                 <!-- Product image-->
                 <img class="card-img-top" src= "{{ $item->image ? $item->image->url() : '' }}" alt="..." />
                 <!-- Product details-->
                 <div class="card-body p-4">
                      <div class="text-center">
                      <!-- Product name-->
                      <h5 class="fw-bolder"><a href="{{ route('items.show', ['item' => $item->id]) }}" class="text-decoration-none">{{ $item->item_name }}</a></h5>
                      <h5 class="fw-bolder">{{ $item->item_content }}</h5>
                      <h6 class="text-muted">{{ $item->item_category }}</h6>
                      <!-- Product price-->
                      1 Kg - Rs {{ $item->price }}
                      </div>
                 </div>
                 <!-- Product actions-->
                 <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                      <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; left: 0.5rem">
                           <p class="card-text">{{ $item->likes_count +30 }} <i class="fa fa-heart" aria-hidden="true"></i> Likes </p>
                      </div>
                      <div class="text-center">
                        <form method="POST" action="{{ route('remove.cart',[$item->id] )}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger mt-2">Remove Cart</button>
                        </form>
                        <a href="{{ route('on',[$item->id]) }}" class="btn btn-outline-success mt-auto">
                            BUY NOW
                        </a> 
       
                      </div>
                 </div>
            </div>
       </div>
       @endforeach
    </div>
  </div>
<a href="/buyAll" class="btn btn-outline-success mt-auto">
    BUY ALL
</a> 
</section>