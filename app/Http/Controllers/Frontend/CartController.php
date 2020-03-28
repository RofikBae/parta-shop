<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Product;

class CartController extends Controller
{
    public function index()
    {
        $productsCart = session('cart');
        $count = $productsCart ? count($productsCart) : 0;

        return view('frontend.cart.index', compact(['productsCart', 'count']));
    }

    public function addItem(Product $product)
    {
        $item = [
            'product_id'     => $product->id,
            'name'           => $product->name,
            'description'    => $product->description,
            'slug'           => $product->slug,
            'price'          => $product->price,
            'formated_price' => $product->getPrice(),
            'image'          => $product->getImage(),
            'qty'            => 1
        ];

        if (session()->has('cart')) {
            session()->push('cart', $item);

            return redirect()->route('frontend.cart.index');
        }

        session()->put('cart', [$item]);

        return redirect()->route('frontend.cart.index');
    }
}
