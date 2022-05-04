@include('layouts')

@foreach($itemId as $item)
          <div class="card box" style="width: 15rem;">
             
               <img src="{{ Storage::url($item->path) }}" class="card-img-top" alt="...">
               <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('items.show', ['item' => $item->item_id]) }}" class="text-decoration-none">{{ $item->item_name }}</a></h5>
                    <p class="card-text">{{ $item->item_content }}</p>
                    <p class="card-text">{{ $item->item_category }}</p>
               </div>
               <ul class="list-group">
                    <li class="list-group-item">1 Kg - Rs {{ $item->price }}</li>
                    
               </ul>
               
          </div>
        <div class="container">
          <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your Order</span>
                <span class="badge bg-primary rounded-pill">1</span>
              </h4>
              <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                  <div>
                    <h6 class="my-0">{{ $item->item_name }}</h6>
                    <small class="text-muted">{{ $item->item_content }}</small>
                  </div>
                  <span class="text-muted">1 Kg - Rs {{ $item->price }} </span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                  <div class="text-success">
                    <small>Use FIRST50 </small>
                    <h6 class="my-0">To Get 50% Off On Your First Order</h6>
                  </div>
                  <span class="text-success">Rs {{ $item->price * $item->qty * 0.5 }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <span>Total (Rs)</span>
                 
                  <strong>{{ $item->price * $item->qty }}</strong>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>You Save </span>
               
                <strong>{{ ($item->price* $item->qty) - ($item->price * $item->qty * 0.5) }} Rs On This Order</strong>
             </li>
             <form method="POST" action="{{ route('confirm',['item' => $item->item_id] )}}">
                    
                @csrf
                <input type="hidden" value="{{ $item->item_id}} " name="itemid">
              <button type="submit" class="btn btn-success mt-2">Place Order</button>

             </form>
              </ul>
            </div>
        </div>
    </div>
    @endforeach
