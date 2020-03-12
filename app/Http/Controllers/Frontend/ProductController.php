<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('frontend.product.show', compact('product'));
    }

    public function byCategory(Category $category)
    {
        $products = $category->products()->paginate(config('app.front_paginate'));

        return view('frontend.product.by-category', compact('products'));
    }
}
