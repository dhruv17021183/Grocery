@include('layouts')
    <div class="container">
        <hr>
            <h4 class="card-title">Your Order Details</h4>
        <hr>
          
@foreach($orders as $order)
   
        <div class="clearfix">
            {{-- <img src="{{ $item->image ? $item->image->url() : '' }}" class="col-md-4 float-md-start mb-3 ms-md-3" alt="..."> --}}
        
           

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
                    You Placed This Order On Today At {{ $order->created_at }}
                </p>
            @else
                <p>
                    You Placed This Order On {{ now()->diffInDays($order->created_at)}}
                </p>
            @endif
            <h4>Status: Expected Delievery By Tommorrow</h4>  
        </div>
    
@endforeach
</div>