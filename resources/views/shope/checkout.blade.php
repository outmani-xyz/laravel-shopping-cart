@extends('layouts.master')
@section('title')
Shopping cart
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Check out.</h2>
            <h4>Your Total : {{ $total }}</h4>
            <div id="charge-error" class="label alert-danger {{ !Session::has('error')? 'hidden':'' }}">
                {{ Session::get('error') }}
            </div>
            <form method="post" action='{{ route('checkout') }}' id="checkout-form">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" id="name" class="form-control" required="" name='name'>
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" id="adresse"  class="form-control" required="" name='adresse'>
                </div>
                <div class="form-group">
                    <label>Card number</label>
                    <input type="text" id="card-number"  class="form-control" required="" name="card_number">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Expiration month</label>
                            <input type="text" id="card-expiry-month"  class="form-control" required="" name="expiry_month">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Expiration year</label>
                            <input type="text" id="card-expiry-year"  class="form-control" required="" name='expiry_year'>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>CVC code</label>
                        <input type="text" id="card-cvc"  class="form-control" required="" name="cvv">
                    </div>
                </div>
                {{ csrf_field() }}
                <button class="btn btn-success">Process</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="//js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ URL::to('js/checkout.js') }}"></script>

@endsection