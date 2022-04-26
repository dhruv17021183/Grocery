@include('layouts')

<form action="{{ route('items.update',['item' => $item->id] )}}" method="POST">
    @csrf
    @method('PUT') 

    @include('item.form')

    <button type="submit" class="btn btn-primary btn-block">Update</button>
</form>