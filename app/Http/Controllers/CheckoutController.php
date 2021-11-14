<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class CheckoutController extends Controller
{
    function checkout($discount = 0)
    {
        $carts = Cart::whereCookieId(Cookie::get('cart'))->get();
        $countries = country::all();
        return view('frontend.checkout', ['carts' => $carts, 'discount' => $discount, 'countries' => $countries]);

    }

    function city(Request $request)
    {
        $cities = City::whereCountryId($request->country_id)->get()->sortBy('name');
        $arr = array();
        foreach ($cities as $city) {
            $str = "<option value='$city->id'>$city->name</option>";
            $arr[] = $str;

        }
        return $arr;


    }

    function phone($id)
    {
        $phone = country::findOrFail($id)->phone_code;
        return '+' . $phone;
    }
}
