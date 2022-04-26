@extends('layouts')

@section('content')
  
    <h1>{{ $item->item_name }}</h1>
    <p>{{ $item->item_content }}</p>
    <p>{{ $item->item_category }}</p>
    <p>{{ $item->price }}</p>
    <p>{{ $item->status }}</p>

@endsection('content')