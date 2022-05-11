@include('layouts')
    {{-- <div class="container card">
       
          
@foreach($orders as $order)
    <div class="container card">
            {{-- <img src="{{ $item->image ? $item->image->url() : '' }}" class="col-md-4 float-md-start mb-3 ms-md-3" alt="..."> 
            <h4 class="card-title">Your Shipping Address</h4>
            <hr>
            <h5>{{ $order->address }}</h5>
            
            <p>
                {{ $order->states }}
            </p>
            <p>
                {{ $order->pincode }}
            </p>
            <hr>
        
            @if( now()->diffInDays($order->created_at) < 1) 
                <p>
                    You Placed This Order On {{ $order->created_at }}
                </p>
            @else
                <p>
                    You Placed This Order {{ now()->diffInDays($order->created_at)}} Day Ago.
                </p>
            @endif
            <h4>Order Status:{{ $order->status }}</h4>  
            <hr>
        </div>
    </div>
@endforeach --}}
<div class="container">
    <hr> 
        <h4 class="card-title">Your Order Details</h4>
    <hr>
</div>

@foreach($orders as $order)
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                Order Details
            </div>
            <div class="card-body">
                <div class="card">
                    <h5> Address </h5>
                    <h5 class="card-title">{{ $order->address }}</h5>
                    <p class="card-text">State : {{ $order->states }}</p>
                </div>
                <p class="card-text"> Order Status:{{ $order->status }} </p>
                {{-- <a href="/items" class="btn btn-primary">Go To Items</a> --}}
                <a href={{ "/items/".$order->item_id }} class="btn btn-success mt-2">
                    Go To Item
               </a>
            </div>
        </div>
    </div>
@endforeach 