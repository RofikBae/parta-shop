@extends('layouts.app')

@section('content')
    <div class="column is-6 is-offset-3">
        <h1 class="title is-2">Shoping Cart</h1>
        @if (!$productsCart)
        <div class="card">
            <div class="card-content">
                <div class="is-size-6 is-info">
                    No item
                </div>
            </div>
        </div>
        @else
            @foreach ($productsCart as $product)
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
        @endif
    </div>
@endsection