@include('layouts.app')
<div class="container">
    <form method="post" action="{{ route('cityorder') }}" >
        @csrf
            <input type="text" name="city" class="form-control">
           <button type="submit" class="btn btn-success">Filter</button>
    </form>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">UserName</th>
            <th scope="col">Address</th>
            <th scope="col">State</th>
            <th scope="col">City</th>
            <th scope="col">Pincode</th>
            <th scope="col">Item Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        
        @foreach($orders as $order)
            <tbody>
            <tr>
                <th scope="row">*</th>
                <td>Mark</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->states }}</td>
                <td>{{ $order->city }}</td>
                <td>{{ $order->pincode }}</td>
                <td>{{ $order->item_name }}</td>
                <td>{{ $order->qty }}</td>
                <td>{{ $order->price * $order->qty }}</td>
                <td>
                    <form method="get" action="{{ route('status') }}" >
                        @csrf
                        <input type="hidden" value="{{ $order->item_id }}" name="item_id">
                        <input type="hidden" value="{{ $order->user_id }}" name="user_id">

                        <select class="form-select" aria-label="Default select example" name="status">
                            <option>Your Order Has Been Shipped</option>
                            <option>Your Order Has Been Delivered By Tomorrow</option>
                            <option>Delivered</option>
                            <option>Cancel</option>
                        </select>
                        <button class="btn btn-success">Solve</button>
                    </form>
                </td>
            </tr>
            </tbody>
        @endforeach
</table>
</div>
</div>