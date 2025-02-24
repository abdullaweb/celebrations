<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function ProductAll()
    {
        $subcatAll = SubCategory::latest()->get();
        return view('admin.sub_category.sub_category_all', compact('subcatAll'));
    }


    public function ProductAdd()
    {
        $categories = Category::all();
        $units = Unit::orderBy('name', 'asc')->get();
        return view('admin.sub_category.sub_category_add', compact('categories', 'units'));
    }

    public function ProductStore(Request $request)
    {
        SubCategory::insert([
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array([
            'message' => 'Sub Category Inserted Successfully',
            'alert_type' => 'success',
        ]);
        return redirect()->route('product.all')->with($notification);
    }

    public function ProductEdit($id)
    {
        $category = Category::all();
        $sub_cat = SubCategory::findOrFail($id);
        $units = Unit::all();
        return view('admin.sub_category.sub_category_edit', compact('category', 'sub_cat','units'));
    }

    public function ProductUpdate(Request $request)
    {
        $sub_cat_id = $request->id;
        SubCategory::findOrFail($sub_cat_id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
             'unit_id' => $request->unit_id,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array([
            'message' => 'Sub Category Updated Successfully',
            'alert_type' => 'success',
        ]);
        return redirect()->route('product.all')->with($notification);
    }

    public function ProductDelete($id)
    {
        SubCategory::findOrFail($id)->delete();
        $notification = array([
            'message' => 'Sub Category Deleted Successfully',
            'alert_type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    }

    public function GetProduct(Request $request)
    {
        $category_id = $request->category_id;
        $allSubCat = SubCategory::where('category_id', $category_id)->get();
        return response()->json($allSubCat);
    }
}
