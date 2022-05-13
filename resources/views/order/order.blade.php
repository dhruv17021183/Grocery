@include('layouts')

  <form action="{{'/orderstore/'.$item_id}}" method ="POST" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="itemid" value="{{ $item_id }} "/>
  <head>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-first">
        {{-- <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your Product Details</span>
        </h4> --}}
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">{{ $item->item_name}}</h6>
              <small class="text-muted">{{ $item->item_content}}</small>
            </div>
           
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <img class="card-img-top" src= "{{ $item->image ? $item->image->url() : '' }}" alt="..." />
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <label for="country" class="form-label">Quantity</label>
              <select class="form-select" id="country" name="qty">
                <option value="">Choose...</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>

              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (RS)</span>
            <strong>{{ $item->price}} Rs Per Item</strong>
          </li>
        </ul>

        {{-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form> --}}
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Billing address</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" name="address" placeholder="1234 Main St">
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
           
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            

            
            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <select class="form-select" name="states">
                <option>Choose...</option>
                <option>Gujrat</option>
                <option>Maharashtra</option>
                <option>Rajsthan</option>
                <option>Delhi</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control" name="city" placeholder="">
              <div class="invalid-feedback">
                City required.
              </div>
            </div>
            <div class="col-md-3">
              <label for="zip" class="form-label">PinCode</label>
              <input type="text" class="form-control" name="pincode" placeholder="">
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
            <div class="col-md-3">
              <label for="number" class="form-label">Mobile Number (Optional)</label>
              <input type="number" class="form-control" name="MN">
              <div class="invalid-feedback">
                Mobile Number
              </div>
            </div>
          </div>

          <hr class="my-4">

         
          <hr class="my-4">

         
          @errors @enderrors
          <button class="w-100 btn btn-primary btn-lg" type="submit"><a href="/orderConfirm"></a>Continue to checkout</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021–2023 Apna Basket</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>

</form>