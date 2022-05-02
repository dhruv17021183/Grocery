@extends('layouts')

@section('content')

     {{-- <div class="container">
          <div class="card" style="width: 15rem;">
               <img src="{{ $item->image ? $item->image->url() : '' }}" class="card-img-top" alt="...">
               <div class="card-body">
                    <h5 class="card-title">{{ $item->item_name }}</h5>
                    <p class="card-text">{{ $item->item_content }}</p>
                    <p class="card-text">{{ $item->item_category }}</p>
               </div>
               <ul class="list-group list-group-flush">
                    <li class="list-group-item">1 Kg - Rs {{ $item->price }}</li>
                    <li class="list-group-item">{{ $item->status }}</li>
                    {{-- <button type="button" class="btn btn-success">Add To Cart</button>
                     
                     <a href="{{ route('items.cart', ['item' => $item->id]) }}" class="btn btn-primary mt-2">
                         Add To Cart
                    </a>
               </ul> 
          </div>
     </div> --}}
     <div class="container">
          <div class="clearfix">
               <img src="{{ $item->image ? $item->image->url() : '' }}" class="col-md-4 float-md-start mb-3 ms-md-3" alt="...">
          
               <h5 class="card-title">{{ $item->item_name }}</h5>
             
               <p>
                  {{ $item->item_content }}
               </p>
             
               <p>
                    {{ $item->item_category }}
               </p>
               <br><br>
               <div class="container">
                    <ul class="list-group list-group-flush">
                         <li class="list-group-item">1 Kg - Rs {{ $item->price }}</li>
                         <li class="list-group-item">{{ $item->status }}</li>
                    </ul>
                    <a href="{{ route('items.cart', ['item' => $item->id]) }}" class="btn btn-primary mt-2">
                         Add To Basket
                    </a>

                    <a href="/ordernow" class="btn btn-success mt-2">
                         Buy Now
                    </a>

               </div>
          </div>
     </div>
     <div class="container">
          <br>
          <br>
          <h4>Reviews And Ratings</h4>
          @include('review.form')
     </div>
     <div class="container">
          @forelse($item->reviews as $review)
               <p class="text-muted">
               {{$review->content}} <br>Rating:{{$review->rating}} Out Of 5
               </p>
               <hr>
          @empty
               <p>No Comments Yet!</p>
          @endforelse
     </div>

@endsection('content')