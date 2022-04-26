@include('layouts')

    @foreach($items as $item)
        <a href="{{ route('items.edit', ['item' => $item->id]) }}" class="btn btn-primary">
            Edit
        </a>
        <form method="POST" action="{{ route('items.destroy',['item' => $item->id] )}}">
            
            @csrf
            @method('DELETE')
           
            <a href="{{ route('items.show', ['item' => $item->id]) }}">
                    {{ $item->item_name }}
            </a>
            
            <button type="submit" class="btn btn-primary btn-block">Delete</button>
        </form>
   
@endforeach