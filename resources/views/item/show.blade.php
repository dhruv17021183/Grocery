@extends('layouts')

@section('content')

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

                    <a href={{"/ordernow/".$item->id}} class="btn btn-success mt-2">
                         Buy Now
                    </a>

               </div>
              
               <form action="{{ route('likes') }}" method = "get">
                    @csrf 
                    
                    <input type="hidden" value="{{ $item->id }}" name="item_id" >
                   
                    <br>
                    <div class="like-content">
  
                         <span>
                         Did you like this Product ? Press like to make it easier for others to see
                         </span>
                    </div>
                    <button class="btn-secondary like-review" type="submit">
                         <i class="fa fa-heart" aria-hidden="true"></i> Like
                    </button>
               </form>
          </div>
     </div>

     @if($confirm === true)
          <div class="container">
               <br>
               <br>
               
               @include('review.form')
          
          @else
          <h4></h4>
          @endif
     </div>

     <div class="container">
          <h4>Reviews And Ratings</h4>
          <hr>
          <hr>
          @forelse($item->reviews as $review)
               <p class="text-muted">
               {{$review->content}} <br>Rating:{{$review->rating}} Out Of 5
               </p>
               <hr>
          @empty
               <p>No Ratings Yet!</p>
          @endforelse
     </div>
@endsection('content')