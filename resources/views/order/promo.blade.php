<form class="card p-2" method="get" action="{{ route('reedem')}}">
    @csrf
    <div class="input-group">

        <input type="hidden" value="{{ $item->item_id }}" name="item_id"/>
     
        <input type="text" class="form-control" placeholder="Promo code" name="promo">
        
        <button type="submit" class="btn btn-secondary">Redeem</button>
    </div>
</form>
