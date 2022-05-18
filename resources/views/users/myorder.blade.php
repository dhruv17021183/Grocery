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
        
    {{-- <h1>{{$order->item_id}}</h1>   --}}
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
                <div class="container">
                    <form action="{{ route('cancelorder') }}" method="post" enctype="multipart/form-data">

                        @csrf
                                            <!-- Button trigger modal -->
                        {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Cancel Order
                        </button> --}}
                            
                        {{-- <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reason For Cancel</h5>
                                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                                    </div>
                                    <div class="modal-body">
                                        <select class="form-select" aria-label="Default select example" name="reason">
                                            <option selected>Item Has Less Quntity </option>
                                            <option>Ordered By Mistake</option>
                                            <option>Found Cheaper Somewhere else</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">

                                    <input type="hidden" value="{{ $order->item_id }}" name="item_id">
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
                                    <button type="button" class="btn btn-success">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <input type="hidden" value="{{ $order->item_id}}" name="item_id">
                        <button type="submit" class="btn btn-danger">Order Cancel</button>

                    </form>
                </div>
            </div>
        </div>
    @endforeach 

