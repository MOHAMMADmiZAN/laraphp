<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\country;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    function checkout($discount = 0)
    {
        $carts = Cart::latest()->get();
        $countries = country::all();
        return view('frontend.checkout', ['carts' => $carts, 'discount' => $discount, 'countries' => $countries]);

    }

    function city(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();
        $arr = array();
        foreach ($cities as $city) {
            $str = "<option value='$city->id'>$city->name</option>";
            $arr[] = $str;

        }
        return $arr;


    }

    function phone($id)
    {
        $country = country::findOrFail($id);
        $phone = $country->phone_code;
        return '+' . $phone;
    }
}
