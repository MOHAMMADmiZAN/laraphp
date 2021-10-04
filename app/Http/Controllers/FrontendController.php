<?php

namespace App\Http\Controllers;

use App\Models\Products;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Products::latest()->get();
        return view("frontend.home",["products" => $products]);
    }
}
