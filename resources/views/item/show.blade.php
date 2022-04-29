@extends('layouts')

@section('content')

     <div class="container">
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
                     --}}
                     <a href="{{ route('items.cart', ['item' => $item->id]) }}" class="btn btn-primary mt-2">
                         Add To Cart
                    </a>
               </ul> 
          </div>
     </div>
     <div class="container">
          <h4>Reviews</h4>
          @include('review.form')
     </div>
     <div class="container">
          @forelse($item->reviews as $review)
               <p class="text-muted">
               {{$review->content}}
               </p>
               <hr>
          @empty
               <p>No Comments Yet!</p>
          @endforelse
     </div>

@endsection('content')