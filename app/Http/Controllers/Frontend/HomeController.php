<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'ASC')->paginate(config('app.front_paginate'));

        return view('frontend.homepage', compact('products'));
    }
}
