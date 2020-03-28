@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        @if (!$products)
            <div class="column is-12">
                <div class="card">
                    <div class="card-content">
                        <div class="is-size-6 is-info">
                            No item
                        </div>
                    </div>
                </div>          
            </div>
        @else
            <div class="column is-8">
                <h1 class="title is-2">Shoping Cart</h1>
                @php
                $totalItem = 0;
                $totalPrice = 0;
                @endphp
                @foreach ($products as $product)
                    @php
                    $totalItem += $product['qty'];
                    $totalPrice += $product['price'];
                    @endphp
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title"> {{ $product['name'] }} </p>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <div class="columns">
                                    <div class="column is-3">
                                        <img src="{{ $product['image'] }}" alt="" class="image">
                                    </div>
                                    <div class="column is-9">
                                        <p> {{ $product['description'] }} </p>
                                        <p> {{ $product['formated_price'] }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="column is-4">
                <h1 class="title is-2">Detail</h1>
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p> Total Item  : {{$totalItem}} </p>
                            <p> Total Price : {{$totalPrice}} </p>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="" class="button is-danger is-fullwidth">Checkout</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection