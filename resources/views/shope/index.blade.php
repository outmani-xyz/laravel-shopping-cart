@extends('layouts.master')
@section('title')
Shopping cart
@endsection
@section('content')
<div class="container">
    @foreach($products->chunk(3) as $productChunk)
    <div class="row">
        @foreach($productChunk as $product)
        <div class="col-md-4 col-sm-6">
            <div class="thumbnail">
                <img src="{{ $product->imagePath }}"/>
                <div class="caption">
                    <h3>{{ $product->title }}</h3>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="clearfix">
                    <strong>{{ $product->price }}</strong>
                    <a href="{{ route('product.addtocart',['id'=>$product->id]) }}" class="pull-right btn btn-primary">Add to cart</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection