<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $products = session('cart');

        if (!auth()->user()) {
            return redirect()->route('login')->with('info', 'Login For Checkout!');
        }

        return view('frontend.checkout.index', compact('products'));
    }
}