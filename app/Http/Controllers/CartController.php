<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\coupon;
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
        $find_cart = Cart::firstWhere(['cookie_id' => Cookie::get($requested_cart), 'product_id' => $request->product_id]);
        if ($find_cart) {
            $find_cart->increment('product_quantity', $request->quantity);

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

    protected function cart_show(coupon $coupon, $coupon_name = "")
    {
        $coupon_discount_percent = 0;
        $coupon_discount = $coupon->firstWhere('coupon_name', $coupon_name);
        if ($coupon_discount) {
            $coupon_discount_percent = $coupon_discount->discount;
        }
        $cart = Cart::where('cookie_id', Cookie::get('cart'))->get();
        return view('frontend.cart', ['cart_products' => $cart, 'discount' => $coupon_discount_percent]);
    }

    function cart_delete($uuid)
    {
        $cart = Cart::findOrFail($uuid);
        $cart->delete();
        return back();
    }

    function cart_update(Request $request, Cart $cart)
    {
        foreach ($request->cart_quantity as $index => $quantity) {

            $cart->findOrFail($index)->update(
                [
                    'product_quantity' => $quantity,
                ]
            );
        }
        return back();
    }


}
