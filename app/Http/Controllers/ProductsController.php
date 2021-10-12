<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Products_thumbnail;
use App\Models\SubCategory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::latest()->with(['category', 'subcategory'])->paginate(5);
        return view('dashboard.Products.index', ["categoryData" => Categories::all(), "subcategoryData" => SubCategory::all(), "productData" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                "product_name" => "required|min:3|max:500",
                "product_quantity" => "required|regex:/^[0-9]+$/|min:1|max:4",
                "product_description" => "required|min:100|max:5000",
                "product_price" => "required|min:3|max:10",
                "categoryChoose" => "required",
                "subcategoryChoose" => "required",
                "product_image" => 'image|max:5000|required',
//                "product_thumbnails" => 'image|max:5000|required',

            ]
        );


        $products = new Products;
        $productImage = $request->product_image;
        $ext = $productImage->getClientOriginalExtension();
        $newProductImageName = Str::random() . Auth::id() . "." . $ext;
        $imgFolder = public_path('assets/dist/upload/products/');
        if (!File::exists($imgFolder)) {
            File::makeDirectory($imgFolder, 0777, true, true);
        }
        $this->extracted($productImage, $imgFolder, $newProductImageName, $request, $products);
        $lastId = $products->id;
        $x = gettype(array());

        if (gettype($request->product_thumbnails) == $x ) {
            foreach ($request->product_thumbnails as $thumbnail) {
                $thumbnails = new Products_thumbnail;
                $ext = $thumbnail->getClientOriginalExtension();
                $newThumbName = Str::random() . $lastId . "." . $ext;
                $imgFolder = public_path('assets/dist/upload/products/thumbnails/');
                if (!File::exists($imgFolder)) {
                    File::makeDirectory($imgFolder, 0777, true, true);
                }
                Image::make($thumbnail)->save($imgFolder . $newThumbName);
                $thumbnails->thumbnail_name = $newThumbName;
                $thumbnails->product_id = $lastId;
                $thumbnails->save();

            }

        }
        return back();
    }

    /**
     * @param $productImage
     * @param string $imgFolder
     * @param string $newProductImageName
     * @param Request $request
     * @param $products
     */
    public function extracted($productImage, string $imgFolder, string $newProductImageName, Request $request, $products): void
    {
        Image::make($productImage)->save($imgFolder . $newProductImageName);
        $products->product_name = $request->product_name;
        $products->product_quantity = $request->product_quantity;
        $products->product_description = $request->product_description;
        $products->product_price = $request->product_price;
        $products->category_id = $request->categoryChoose;
        $products->sub_category_id = $request->subcategoryChoose;
        $products->product_photo = $newProductImageName;
        $products->save();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Products $products
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Products $products, $id)
    {
        $productsData = $products->findOrFail($id);
        return view('dashboard.Products.edit', ["products" => $productsData, "categoryData" => Categories::all(), "subcategoryData" => SubCategory::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products, $id)
    {
        $request->validate(
            [
                "product_name" => "required|min:3|max:50",
                "product_quantity" => "required|regex:/^[0-9]+$/|min:1|max:4",
                "product_description" => "required|min:100|max:5000",
                "product_price" => "required|min:3|max:10",
                "categoryChoose" => "required",
                "subcategoryChoose" => "required",
                "product_image" => 'image|max:5000|required',

            ]
        );
        $products = $products->findOrFail($id);
        $productImage = $request->product_image;
        $ext = $productImage->getClientOriginalExtension();
        $newProductImageName = Str::random() . Auth::id() . "." . $ext;
        $imgFolder = public_path('assets/dist/upload/products/');
        if (!File::exists($imgFolder)) {
            File::makeDirectory($imgFolder, 0777, true, true);
        }
        if ($products->product_photo !== "default.png") {
            $deletePath = $imgFolder . $products->product_photo;
            File::delete($deletePath);


        }
        $this->extracted($productImage, $imgFolder, $newProductImageName, $request, $products);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Products $products
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Products $products, $id)
    {
        $products->findOrFail($id)->delete();
        return redirect()->back();
    }
}
