@extends('layouts.master')
@section('title')
Shopping cart
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if(Session::has('cart'))
            <ul class="list-group">
                @foreach($products as $product)
                <li class="list-group-item">
                    <span class="badge">Price : {{ $product['price'] }}</span>  
                    <strong>{{ $product['item']['title'] }}</strong>   
                    <span class="badge">Qty : {{ $product['qty'] }}</span>



                    <div class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle"  id="dropdownMenuAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Action
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuAction">
                            <li><a href="{{ route('product.reduceone',['id'=>$product['item']['id']]) }}">Reduce by one</a></li>
                            <li><a href="{{ route('product.reduceAll',['id'=>$product['item']['id']]) }}">Reduce all</a></li>
                        </ul>
                    </div>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <strong>Total: {{ $totalPrice }}</strong>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <a href="{{ route('checkout') }}" class="btn btn-success">Check out.</a>
    </div>
</div>
@else 

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>No item in cart.</h2>      
    </div>
</div>
@endif
</div>
@endsection