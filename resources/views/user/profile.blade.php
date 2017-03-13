@extends('layouts.master')

@section('content')
<div class="container">
    @include('partials.infos')
    <div class="row">
        <h2>My Profile</h2><hr>
        <h3>List of my orders</h3>
        @foreach($orders as $order)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Payment ID: {{ $order->payment_id }}</div>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($order->cart->items as $item)
                        <li class="list-group-item">
                            <span class="badge">Price : {{ $item['price'] }}</span>  
                            <strong>{{ $item['item']['title'] }}</strong>   
                            <span class="badge">Qty : {{ $item['qty'] }}</span>   
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection