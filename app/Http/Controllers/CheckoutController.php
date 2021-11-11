<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function checkout($discount = 0)
    {
        $carts = Cart::latest()->get();
        return view('frontend.checkout', ['carts' => $carts, 'discount' => $discount]);

    }
}
