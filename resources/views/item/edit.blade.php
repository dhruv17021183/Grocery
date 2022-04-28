@include('layouts')

<form action="{{ route('items.update',['item' => $item->id] )}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') 

    @include('item.form')

    <button type="submit" class="btn btn-primary btn-block">Update</button>
</form>