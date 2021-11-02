<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
            ['categoryName' => 'required|regex:/^[a-zA-Z ]+$/|min:3|max:30|unique:categories'], // {WITH unique:categories validate}
            ['categoryName.regex' => 'Please Type validate Category Name']

        );
        $category = new Categories;
        $category_photo = $request->category_photo;
        $ext = $category_photo->getClientOriginalExtension();

        $category_photo_name = Str::uuid() . '.' . $ext;
        print_r($category_photo_name);
        $imgFolder = public_path('assets/dist/upload/category/');
        if (!File::exists($imgFolder)) {
            File::makeDirectory($imgFolder, 0777, true, true);
        }
        Image::make($category_photo)->save($imgFolder . $category_photo_name);
        $category->$categoryName = $request->$categoryName;
        $category->$slug = Str::slug($request->$categoryName);
        $category->category_photo = $category_photo_name;
        $category->save();
        return redirect()->back()->with('success', 'Category Added Successfully'); // with with flash session


//        return back();
    }

    public function categoriesView()
    {
        return view('dashboard.categories.categoriesViews', ['categoryData' => Categories::latest()->withoutTrashed()->paginate(5)]);
    }

    public function categoriesEdit($id)
    {

        return view('dashboard.categories.categoriesEdit', ['categoryDataEdit' => Categories::findOrFail($id)]);
    }

    public function categoriesEditResponse(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $prev_photo = $category->category_photo;
        $categoryName = 'categoryName';
        $slug = 'slug';
        $request->validate(
            ['categoryName' => 'required|regex:/^[a-zA-Z ]+$/|min:3|max:10',], // {WITH unique:categories validate}
            ['categoryName.regex' => 'Please Type validate Category Name']

        );
        $category_photo = $request->category_photo;
        $imgFolder = public_path('assets/dist/upload/category/');
        if ($request->hasFile('category_photo')) {
            $ext = $category_photo->getClientOriginalExtension();
            $category_photo_name = Str::uuid() . '.' . $ext;
            Image::make($category_photo)->save($imgFolder . $category_photo_name);
            if ($prev_photo != 'default.jpg') {
                File::delete($imgFolder . $prev_photo);
            }
            $this->extracted($slug, $categoryName, $request, $category, $category_photo_name);

        } else {
            $this->extracted($slug, $categoryName, $request, $category, $prev_photo);
        }

        return redirect()->back()->with('success', 'Category Update Successfully'); // with with flash session

    }

    public function categoriesSoftDelete($id)
    {
        $deletedData = Categories::findOrFail($id);
        $deletedData->delete();
        return redirect()->back()->with('deleted', 'Category Data Move To Task');

    }

    public function categoriesTrashed()
    {
        return view('dashboard.categories.categoriesTrashed', ['categoryData' => Categories::latest()->onlyTrashed()->paginate(5)]);
    }

    public function categoriesRestore($id)
    {
        $restoreData = Categories::onlyTrashed()->findOrFail($id);
        $restoreData->restore();
        return redirect()->back()->with('restore', 'Category Data Restore Successfully');
    }

    public function categoriesDelete($id)
    {
        $forceDeletedData = Categories::onlyTrashed()->findOrFail($id);
        $imgFolder = public_path('assets/dist/upload/category/');
        File::delete($imgFolder . $forceDeletedData->category_photo);
        $forceDeletedData->forceDelete();
        return redirect()->back()->with('force', 'Category Data Permanently Deleted');

    }

    /**
     * @param string $slug
     * @param string $categoryName
     * @param Request $request
     * @param $category
     * @param string $category_photo_name
     */
    public function extracted(string $slug, string $categoryName, Request $request, $category, string $category_photo_name): void
    {
        $fileCheck = Categories::where($slug, Str::slug($request->$categoryName))->exists();
        $category->$categoryName = $request->$categoryName;
        $category->category_photo = $category_photo_name;
        $fileCheck === true ? $category->$slug = Str::slug($request->$categoryName) . '-' . Str::random(8) . '-' . Carbon::now('Asia/Dhaka')->format('Y-m-d g:i:s A') : $category->$slug = Str::slug($request->$categoryName);
        $category->save();
    }

}
