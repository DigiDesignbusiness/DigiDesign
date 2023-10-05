<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function allProducts(){
        $products = Product::all();
        return view('admin.products.all-products')->with('products', $products);
    }

    public function createProduct(){
        $categories = Category::all();
        return view('admin.products.create-product', compact('categories'));
    }

    public function storeProduct(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'quantity' => 'required',
            'price' => 'required',
            'discount' => 'nullable',
            'category_id' => 'required'
        ]);
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->category_id = $request->category_id;

        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('productImage', $imagename);

        $product->image = $imagename;

        $product->save();

        Session::flash('statuscode', "success");
        return redirect()->route('all-products')->with('status', 'Product Created.');
    }
    
    public function deleteProduct($id){
        $product = Product::find($id);

        // $file_path = public_path('productImage'). '/' . $product->image;

        // if(File::exists($file_path)) {
        //     File::delete($file_path);
        // }
        $product->delete();
        return response()->json(['status'=>'Product Deleted.']);
    }
    
    public function editProduct(){

    }

    public function updateProduct(){

    }

}
