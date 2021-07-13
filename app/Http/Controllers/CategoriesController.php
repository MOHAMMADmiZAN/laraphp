<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function categoriesAdd()
    {
        return view('dashboard.categories.categoriesAdd');
    }

    public function categoriesPost(Request $request)

    {
        $categoryName = 'categoryName';
        $slug = 'slug';
        $request->validate(
            ['categoryName' => 'required|regex:/^[a-zA-Z ]+$/|min:3|max:10'],
            ['categoryName.regex' => 'Please Type validate Category Name']

        );
        $category = new categories;
        $category->$categoryName = $request->$categoryName;
        $category->$slug = Str::slug($request->$categoryName);
        $category->save();
        return back();
    }
}
