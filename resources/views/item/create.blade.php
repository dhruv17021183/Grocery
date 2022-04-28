@include('layouts')

<form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
    @csrf

    @include('item.form')
    
    @errors @enderrors
    <button type="submit" class="btn btn-primary btn-block mr">Create!</button>
    
</form>
