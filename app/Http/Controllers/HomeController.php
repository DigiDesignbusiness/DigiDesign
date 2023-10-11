<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe;

class HomeController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('home.index',compact('products'));
    }

    public function productDetail($id){
        $product = Product::find($id);
        return view('home.product.single-product', compact('product'));
    }

    public function addToCart(Request $request, $id){
        if(Auth::id()) {
            $user = Auth::user();

            $product = Product::find($id);

            $cart = new Cart();
            
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            if($product->discount != null){
                $cart->price = $product->discount * $request->quantity;
            }else {
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
            $cart->save();

            return redirect()->back();
        }else {
            return Redirect('login');
        }
    }

    public function showCart(){
        if(Auth::id()){
            $id = Auth::user()->id;
        
            $carts = Cart::where('user_id', $id)->get();

            return view('home.cart.show-cart', compact('carts'));
        }
        else{
            return redirect('login');
        }
    }

    public function removeCartItem($id){
        $cartItem = Cart::find($id);
        $cartItem->delete();
        return redirect()->back();
    }

    public function cashOrder(){
        $userId = Auth::user()->id;

        $cartInfo = Cart::where('user_id', $userId)->get();

        foreach($cartInfo as $data){
            $order = new Order();

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Cash on Delivery';
            $order->delivery_status = 'Processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();           
        }
        return redirect()->back();
    }
}