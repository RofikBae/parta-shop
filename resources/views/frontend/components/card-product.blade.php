<div class="column is-2">
    <div class="card">
        <div class="card-image is-4by3">
            <figure>
                <img src="{{$product->getImage()}}" alt="" srcset="">
            </figure>
        </div>
        <div class="card-content">
            <a href="{{route('frontend.product.show',$product)}}"><h5>{{$product->name}}</h5></a>
            <p class="has-text-danger">{{ $product->getPrice() }}</p>

            <a class="button is-info is-small" href="{{ route('frontend.cart.add.item',$product) }}">Add to cart</a>
        </div>
    </div>
</div>