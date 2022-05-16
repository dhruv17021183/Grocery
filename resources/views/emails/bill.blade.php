
@component('mail::message')
# You SuccessFully Purchase Order

<p> Your Item Price Is {{ $items[0]->price * $items[0]->qty }} </p>

@component('mail::button', ['url' => route('items.show', ['item' => $items[0]->item_id])])
View Your Item
@endcomponent

<p>
    {{-- <img src="{{ $message->embed($comment->user->image->url()) }}"/> --}}
    {{-- <img src="{{ Storage::url($items[0]->path) }}" class="card-img-top" alt="..."> --}}
    {{-- <img src="{{ asset($items[0]->path) }}" alt=""> --}}
</p>

@component('mail::panel')
{{ $items[0]->address }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
