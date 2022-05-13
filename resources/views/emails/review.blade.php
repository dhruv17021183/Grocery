
@component('mail::message')# Please Review

{{-- Hi {{ $user->name }} --}}

@component('mail::button', ['url' => route('items.show', ['item' => $item])])
View The Blog Post
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent