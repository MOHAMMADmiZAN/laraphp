<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
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
            ['categoryName' => 'required|regex:/^[a-zA-Z ]+$/|min:3|max:10'], // {WITH unique:categories validate}
            ['categoryName.regex' => 'Please Type validate Category Name']

        );
        $fileCheck = Categories::where($slug, Str::slug($request->$categoryName))->exists();
        $category = new Categories;
        $category->$categoryName = $request->$categoryName;
        $fileCheck === true ? $category->$slug = Str::slug($request->$categoryName) . '-' . Str::random(8) : $category->$slug = Str::slug($request->$categoryName);
        $category->save();
        return redirect(route('categoriesAdd'))->with('success', 'Category Added Successfully'); // with with flash session


//        return back();
    }

    public function categoriesView()
    {
        return view('dashboard.categories.categoriesViews',['categoryData' =>Categories::paginate(5)]);
    }
}
