@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column is-2">
            @include('frontend.components.sidebar')
        </div>

        <div class="column is-10">
            <div class="columns is-multiline">
                @foreach ($products as $product)
                    @include('frontend.components.card-product', $product)
                @endforeach
            </div>
            {{$products->links('vendor.pagination.bulma')}}
        </div>
    </div>
@endsection