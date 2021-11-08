<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\coupon;
use Carbon\Carbon;
use Cookie;
use Illuminate\Http\Request;
use Route;

class CouponController extends Controller
{
    function __construct(coupon $coupon)
    {
        $validity = Carbon::now()->format('y-m-d');
        $coupon->where('validity', "<", $validity)->delete();

    }

    function coupon_index()
    {
        $validity = Carbon::now()->format('y-m-d');
        $coupons = coupon::latest()->get();
        return view('dashboard.coupon.coupon', ['coupons' => $coupons, 'v' => $validity]);
    }

    function coupon_add(Request $request, coupon $coupon)
    {
        $request->validate([
            "coupon_name" => 'required|min:3|max:10',
            "coupon_validity" => 'required|date',
            "coupon_discount" => 'required',
        ]);
        $coupon->coupon_name = $request->coupon_name;
        $coupon->validity = $request->coupon_validity;
        $coupon->discount = $request->coupon_discount;
        $coupon->save();
        return redirect()->back();
    }

    function coupon_delete($id)
    {
        $coupon = coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->back()->with('delete', 'Coupon Deleted Successfully');

    }

    function coupon_match(coupon $coupon, $coupon_name)
    {
        $validity = Carbon::now()->format('y-m-d');
        $coupon->where('validity', "<", $validity)->delete();
        $coupon_discount_percent = 0;
        $coupon_discount = $coupon->firstWhere('coupon_name', $coupon_name);
        if ($coupon_discount) {
            $coupon_discount_percent = $coupon_discount->discount;
        }
        if (!$coupon_discount) {
            return redirect()->route('cart_show')->with('invalid', 'coupon Invalid');
        }

        $cart = Cart::where('cookie_id', Cookie::get('cart'))->get();
        return view('frontend.cart', ['coupon_discount' => $coupon_discount, 'discount' => $coupon_discount_percent, 'cart_products' => $cart,]);
    }


}
