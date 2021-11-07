<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

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




}
