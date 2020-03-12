@extends('layouts.app')

@section('content')
        <div class="columns">
            <div class="column is-2">
                <aside class="menu">
                    <p class="menu-label">Categories</p>
                </aside>
                <ul class="menu-list">
                    <li><a href="http://">Category 1</a></li>
                    <li><a href="http://">Category 2</a></li>
                    <li><a href="http://">Category 3</a></li>
                </ul>
            </div>

            <div class="column is-10">
                <div class="columns is-multiline">
                    @foreach ($products as $product)
                    <div class="column is-2">
                        <div class="card">
                            <div class="card-image is-4by3">
                                <figure>
                                    <img src="{{$product->getImage()}}" alt="" srcset="">
                                </figure>
                            </div>
                            <div class="card-content">
                                <p>{{$product->name}}</p>

                                <a class="button is-info is-small" href="http://">Add to cart</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection