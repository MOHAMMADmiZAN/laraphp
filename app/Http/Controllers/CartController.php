<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class CartController extends Controller
{
    public function cart_store(Request $request)
    {
        $requested_cart = 'cart';
        $random = Str::random(16) . time();
        $request->hasCookie($requested_cart) ? $random = Cookie::get($requested_cart) : Cookie::queue(Cookie::make($requested_cart, $random, 500));
        if (Cart::firstWhere(['cookie_id' => Cookie::get($requested_cart), 'product_id' => $request->product_id])) {
            Cart::firstWhere(['cookie_id' => Cookie::get($requested_cart), 'product_id' => $request->product_id])->increment('product_quantity', $request->quantity);

        } else {
            $cart = new Cart;
            $cart->id = Str::uuid();
            $cart->cookie_id = $random;
            $cart->product_id = $request->product_id;
            $cart->product_quantity = $request->quantity;
            $cart->save();
        }


        return back();


    }


}
