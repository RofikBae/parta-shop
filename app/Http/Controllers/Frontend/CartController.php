<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Product;

class CartController extends Controller
{
    public function index()
    {
        $products = session('cart');
        return view('frontend.cart.index', compact('products'));
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

            return redirect()->route('homepage');
        }

        session()->put('cart', [$item]);

        return redirect()->route('homepage');
    }
}
