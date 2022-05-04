@include('layouts')

<div class="container">
    <div class="clearfix">
         {{-- <img src="{{ $item->image ? $item->image->url() : '' }}" class="col-md-4 float-md-start mb-3 ms-md-3" alt="..."> --}}
    
         <hr>
         <h4 class="card-title">Your Order Details</h4>
         <hr>

         <h4 class="card-title">Your Shipping Address</h4>
         <hr>
         <h5>{{ $userorder[0]->address }}</h5>
         
         <p>
            {{ $userorder[0]->states }}
        </p>
        <p>
            {{ $userorder[0]->pincode }}
        </p>
        <hr>
       
        @if( now()->diffInDays($userorder[0]->created_at) < 1) 
            <p>
                You Placed This Order On Today At {{ $userorder[0]->created_at }}
            </p>
        @else
            <p>
                You Placed This Order On {{ now()->diffInDays($userorder[0]->created_at)}}
            </p>
        @endif
        <h4>Status: Expected Delievery By Tommorrow</h4>  
    </div>
</div>