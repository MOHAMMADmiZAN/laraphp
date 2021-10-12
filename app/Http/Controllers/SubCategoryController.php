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
        $subCategoryData = SubCategory::latest()->with('category')->withoutTrashed()->paginate(5);
        return view('dashboard.subcategory.subcategoryIndex', ['categoryData' => $categoryData, 'subCategoryData' => $subCategoryData]);
    }

    public function subCategoryInsert(Request $request)
    {
        $subCategoryName = 'subCategoryName';
        $slug = 'slug';
        $request->validate(
            [
                'subCategoryName' => 'required|regex:/^[a-zA-Z ]+$/|min:2|max:30|unique:sub_categories',
                'categoryChoose' => 'required'
            ]
        );
        $subCategory = new SubCategory;
        $subCategory->$subCategoryName = $request->$subCategoryName;
        $subCategory->$slug = Str::slug($request->$subCategoryName);
        $subCategory->category_id = $request->categoryChoose;
        $subCategory->created_at = Carbon::now('Asia/Dhaka');
        $subCategory->save();
        return redirect()->back()->with('success', ' SubCategory Added Successfully'); // with with flash session


    }

    public function subCategoryEdit($id)
    {
        return view('dashboard.subcategory.subCategoryEdit', ['subCategoryDataEdit' => SubCategory::findOrFail($id), 'categoryData' => Categories::all()]);
    }

    public function subCategoryDataEditResponse(Request $request, $id)
    {
        $subCategoryName = 'subCategoryName';
        $slug = 'slug';
        $request->validate(
            [
                'subCategoryName' => 'required|regex:/^[a-zA-Z ]+$/|min:2|max:30|unique:sub_categories',
                'categoryChoose' => 'required'
            ]
        );
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->$subCategoryName = $request->$subCategoryName;
        $subCategory->$slug = Str::slug($request->$subCategoryName);
        $subCategory->category_id = $request->categoryChoose;
        $subCategory->updated_at = Carbon::now('Asia/Dhaka');
        $subCategory->save();
        return redirect()->back()->with('success', ' SubCategory Edit Successfully'); // with with flash session
    }

    public function subCategorySoft($id)
    {
        $subCategory = SubCategory::withoutTrashed()->findOrFail($id);
        $subCategory->delete();
        return redirect()->back()->with('deleted', ' SubCategory Delete Successfully'); // with flash session


    }

    public function subCategoryTrash()
    {

        return view('dashboard.subcategory.subCategoryTrashed', ['subCategoryTrashData' => SubCategory::onlyTrashed()->latest()->paginate(5)]);
    }

    public function subCategoryRestore($id)
    {
        $subCategory = SubCategory::onlyTrashed()->findOrFail($id);
        $subCategory->restore();
        return redirect()->back()->with('success', ' SubCategory restore Successfully'); //
    }

    public function subCategoryDeleted($id)
    {
        $subCategory = SubCategory::onlyTrashed()->findOrFail($id);
        $subCategory->forceDelete();
        return redirect()->back()->with('forceDeleted', ' SubCategory Deleted Permanently');


    }

    public function subCategoryCheck(Request $request)
    {
        $ids = $request->mark;
        if ($request->soft === 'soft') {
            foreach ($ids as $id) {
                $subCategory = SubCategory::withoutTrashed()->findOrFail($id);
                $subCategory->delete();
            }
            return redirect()->back()->with('deleted', ' SubCategory Delete Successfully'); // with flash session
        }
        if ($request->restore === 'restore') {
            foreach ($ids as $id) {
                $subCategory = SubCategory::onlyTrashed()->findOrFail($id);
                $subCategory->restore();
            }
            return redirect()->back()->with('success', ' SubCategory restore Successfully'); //// with flash session
        }
        if ($request->remove === 'remove') {
            foreach ($ids as $id) {
                $subCategory = SubCategory::onlyTrashed()->findOrFail($id);
                $subCategory->forceDelete();
            }
            return redirect()->back()->with('forceDeleted', ' SubCategory Deleted Permanently'); // with flash session
        }


    }
}
