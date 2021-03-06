<?php

namespace App\Http\Controllers;

use App\Mail\sendinvoice;
use App\Models\Cart;
use App\Models\City;
use App\Models\country;
use App\Models\Order;
use App\Models\OrderBillingDetails;
use App\Models\OrderProductsDetails;
use App\Models\Products;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;


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

    function order(Request $request)
    {
        $last_insert_id = Order::insertGetId([
            'user_id' => auth()->id(),
            'subtotal' => $request->sub_total,
            'total' => $request->total,
            'discount' => $request->discount,
            'payment_method' => $request->payment_method,
            'created_at' => now()

        ]);
        return $last_insert_id;


    }

    function billing_details(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'notes' => 'required'
        ]);
        OrderBillingDetails::insert([
            'user_id' => auth()->id(),
            'order_id' => $request->lastId,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'zip' => $request->zip,
            'address' => $request->address,
            'notes' => $request->notes,
            'created_at' => now(),

        ]);
        $cart_products = Cart::whereCookieId(Cookie::get('cart'))->get();
        $order_id = $request->lastId;
        Mail::to('takbir.jcd@gmail.com')->send(new sendinvoice($order_id));
        return [$request->lastId, $cart_products];
    }

    function ordered_products(Request $request)
    {

        $product = Products::whereId($request->product_id)->first();

        OrderProductsDetails::insert([
            "order_id" => $request->lastId,
            "user_id" => auth()->id(),
            "product_id" => $request->product_id,
            "product_name" => $product->product_name,
            "product_quantity" => $request->product_quantity,
            "product_price" => $product->product_price * $request->product_quantity,
            'created_at' => now()
        ]);
        Products::whereId($request->product_id)->decrement('product_quantity', $request->product_quantity);
        Cart::whereCookieId(Cookie::get('cart'))->delete();
        Cookie::queue(Cookie::forget('cart'));
        return route('checkout');


    }

    function stripeIndex()
    {
        return view('frontend.stripe');
    }


    function stripe_payment(Request $request)
    {
        try {
            //cartalyst/stripe-laravel package
            Stripe::charges()->create([

                'amount' => $request->__totals / 85,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => $request->__Order_Description,


            ]);
            return redirect()->route('shop');

        } catch (\Exception $e) {

            return back()->with('card-decline', $e->getMessage());

        }


    }
}
