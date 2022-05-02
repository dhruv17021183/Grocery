@include('layouts')
  <form action="{{'/orderstore/'.$item_id}}" method ="POST" enctype="multipart/form-data">
    @csrf 
    <input type="text" name="itemid" value="{{ $item_id }} "/>

    <div class="container">
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="qty" class="form-control"
                value="qty" min="1" max="5"/>
        </div>
        
        <div class="form-group">
            Add Address
            <textarea type="text" name="address" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>States</label>
                <select class="form-select" aria-label="Default select example" name="states">
                        <option>Gujrat</option>
                        <option>Maharashtra</option>
                        <option>Rajsthan</option>
                        <option>Delhi</option>
                </select>
        </div>

        <div class="form-group">
            <label>PinCode</label>
            <input type="number" name="pincode" class="form-control"
                value="pincode"/>
        </div>
        
        @errors @enderrors
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
        
    </div>
</form>