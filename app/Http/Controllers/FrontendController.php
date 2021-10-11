<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Products_thumbnail;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Products::latest()->with(['category', 'subcategory'])->get();
        return view("frontend.home", ["products" => $products]);
    }

    public function singleProduct($id)
    {
        $single = Products::findOrFail($id);
        $category_id = Products::findOrFail($id)->category_id;
        $relationalProduct = Products::where('category_id', $category_id)->where("id", "!=", $id)->get();
        $thumbnailPhoto = Products_thumbnail::where('product_id',$id)->get();
        return view("frontend.single-product", ["singleProductData" => $single, "relationalProduct" => $relationalProduct, "thumbnailPhoto" => $thumbnailPhoto]);
    }
}
