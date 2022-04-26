@include('layouts')

<form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
    @csrf

    @include('item.form')

    <button type="submit" class="btn btn-primary btn-block">Create!</button>
</form>