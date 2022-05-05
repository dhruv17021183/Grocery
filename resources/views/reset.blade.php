@extends('layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Enter Your OTP') }}</div>

                <div class="card-body">
                    <form method="get" action="{{ route('otpverify') }}">
                        @csrf                   
                        <div class="row mb-3">
                            <label for="number" class="col-md-4 col-form-label text-md-end">{{ __('Otp') }}</label>
                            <div class="col-md-6">
                                <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="otp">
                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection