@extends('layouts')

@section('content')

{{-- <h1>{{ $item->item_name }}</h1>
<p>{{ $item->item_content }}</p>
<p>{{ $item->item_category }}</p>
<p>{{ $item->price }}</p>
<p>{{ $item->status }}</p>

<div class="col-4">
     <img src="{{ $item->image ? $item->image->url() : '' }}" class="img-thumbnail avatar" />
</div> --}}
<div class="container row row-cols-1 row-cols-md-2 g-4 box">
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
               <button type="button" class="btn btn-success">Add To Cart</button>
          </ul>
          
     </div>
</div>

@endsection('content')