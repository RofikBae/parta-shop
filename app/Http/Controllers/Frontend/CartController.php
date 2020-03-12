<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addItem(Product $product)
    {
        session()->forget('cart');

        $item = [
            'product_id' => $product->id,
            'name'       => $product->name,
            'slug'       => $product->slug,
            'price'      => $product->price,
            'image'      => $product->getImage(),
            'qty'        => 1
        ];

        if (session()->has('cart')) {
            session()->push('cart', $item);

            return session('cart');
        }

        session()->put('cart', [$item]);

        return session('cart');
    }
}
