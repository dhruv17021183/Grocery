@include('layouts')

{{-- @foreach($itemId as $item) --}}

          <div class="card box" style="width: 15rem;">
             
               <img src="{{ Storage::url($item[0]->path) }}" class="card-img-top" alt="...">
               <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('items.show', ['item' => $item[0]->item_id]) }}" class="text-decoration-none">{{ $item[0]->item_name }}</a></h5>
                    <p class="card-text">{{ $item[0]->item_content }}</p>
                    <p class="card-text">{{ $item[0]->item_category }}</p>
               </div>
               <ul class="list-group">
                    <li class="list-group-item">1 Kg - Rs {{ $item[0]->price }}</li>
                    
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
                    <h6 class="my-0">{{ $item[0]->item_name }}</h6>
                    <small class="text-muted">{{ $item[0]->item_content }}</small>
                  </div>
                  <span class="text-muted">1 Kg - Rs {{ $item[0]->price }} </span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <span>Quantity</span>
                 
                  <strong>{{ ($item[0]->qty) }}</strong>
                </li>
                {{-- <li class="list-group-item d-flex justify-content-between bg-light">
                  <div class="text-success">
                    <small>Use FIRST50 </small>
                    <h6 class="my-0">To Get 50% Off On Your First Order</h6>
                  </div>
                  <span class="text-success">Rs {{ $item[0]->price * $item[0]->qty * 0.5 }}</span>
                </li> --}}
                <li class="list-group-item d-flex justify-content-between">
                  <span>Price (Rs)</span>
                 
                  <strong>{{ $item[0]->price * $item[0]->qty }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <span>TAX 10%  (Rs)</span>
                 
                  <strong>{{ $item[0]->price * $item[0]->qty *.1 }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                  <span class="text-success">Total (Rs)</span>
                 
                  <strong class="text-success">{{ $item[0]->price * $item[0]->qty + $item[0]->price * $item[0]->qty *.1}}</strong>
                </li>
                
              {{-- <li class="list-group-item d-flex justify-content-between">
                <span>You Save </span>
               
                <strong>{{ ($item[0]->price* $item[0]->qty) - ($item[0]->price * $item[0]->qty * 0.5) }} Rs On This Order</strong>
                <h4>{{ $price}}</h4>
             </li> --}}
             {{-- <form class="card p-2" action="{{ route('confirm') }}" method="post">
                @csrf
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Promo code" name="promo">
                  <input type="hidden" value="{{ $item[0]->item_id}} " name="itemid">
                  <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
             </form> --}}
             <div class="container p-3">
             <form method="post" action="{{ route('confirm',['item' => $item[0]->item_id] )}}" class="form-control border-bottom-0 mb-2">
                    
                @csrf
               
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="Debit" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      Debit Card
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="COD">
                    <label class="form-check-label" for="exampleRadios2">
                      Cash On Delivery
                    </label>
                  </div>
       
                <input type="hidden" value="{{ $item[0]->item_id}} " name="itemid">
              <button type="submit" class="btn btn-success mt-2">Place Order</button>
             </form>
            </div>
              </ul>
            </div>
        </div>
    </div>
    
    {{-- @endforeach --}}
