<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Products_thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Products::latest()->with(['category', 'subcategory'])->get();
        $category = Categories::with("products")->get();
        return view("frontend.home", ["products" => $products, "categories" => $category]);
    }

    public function singleProduct($id, Request $request)
    {
        if ($request->hasValidSignature()){
           $single = Products::findOrFail($id);
           $subcategory_id = Products::findOrFail($id)->sub_category_id;
           $relationalProduct = Products::where('sub_category_id', $subcategory_id)->where("id", "!=", $id)->get();
           $thumbnailPhoto = Products_thumbnail::where('product_id', $id)->get();
           return view("frontend.single-product", ["singleProductData" => $single, "relationalProduct" => $relationalProduct, "thumbnailPhoto" => $thumbnailPhoto]);
       }else{
           abort(403);
       }
    }

    public function shop()
    {
        $products = Products::latest()->with(['category', 'subcategory'])->get();
        $category = Categories::with('products')->orderBy('categoryName')->get();
        return view::make("frontend.shop", ["productData" => $products, 'categoryData' => $category]);
    }

    public function category_shop($id)
    {
        $category_product = Products::where("category_id", $id)->latest()->get();
        return view::make("frontend.category_shop", ["category_product" => $category_product]);
    }
}
