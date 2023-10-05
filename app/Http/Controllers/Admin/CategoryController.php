<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function allCategories(){
        $categories = Category::all();
        return view('admin.categories.all-categories', compact('categories'));
    }

    public function createCategory(){
        return view('admin.categories.create-category');
    }

    public function storeCategory(Request $request){

        $request->validate([
            'categoryName' => ['required', 'string', 'max:255']
        ]);

        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->save();
        Session::flash('statuscode', 'success');
        return redirect(route('all-categories'))->with('status', 'Data saved.');
    }

    public function editCategory($id){
        $category = Category::find($id);
        return view('admin.categories.edit-category')->with('category', $category);
    }

    public function updateCategory(Request $request, $id){

        $request->validate([
            'categoryName' => ['required', 'string', 'max:255']
        ]);

        $category = Category::find($id);
        $category->categoryName = $request->categoryName;
        $category->update();
        Session::flash('statuscode', "success");
        return redirect(route('all-categories'))->with('status', 'Data Updated.');
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return response()->json(['status'=>'Category Deleted.']);
    }
}
