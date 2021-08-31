<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categoryData = Categories::orderBy('categoryName', 'asc')->get();
        $subCategoryData = SubCategory::latest()->paginate(5);
        return view('dashboard.subcategory.subcategoryIndex', ['categoryData' => $categoryData, 'subCategoryData' => $subCategoryData]);
    }

    public function subCategoryInsert(Request $request)
    {
        $subCategoryName = 'subCategoryName';
        $slug = 'slug';
        $request->validate(
            [
                'subCategoryName' => 'required|regex:/^[a-zA-Z ]+$/|min:3|max:10|unique:sub_categories',
                'categoryChoose' => 'required'
            ]
        );
        $subCategory = new SubCategory;
        $subCategory->$subCategoryName = $request->$subCategoryName;
        $subCategory->$slug = Str::slug($request->$subCategoryName);
        $subCategory->categoryId = $request->categoryChoose;
        $subCategory->created_at = Carbon::now('Asia/Dhaka');
        $subCategory->save();
        return redirect()->back()->with('success', ' SubCategory Added Successfully'); // with with flash session


    }

    public function subCategoryEdit($id)
    {
        return view('dashboard.subcategory.subCategoryEdit', ['subCategoryDataEdit' => SubCategory::findOrFail($id), 'categoryData' => Categories::all()]);
    }
}
