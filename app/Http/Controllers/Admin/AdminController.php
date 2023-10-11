<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function allOrders(){

        $orders = Order::all();
        return view('admin.orders.all-orders', compact('orders'));
    }

    public function delivered($id){
        $order = Order::find($id);
        $order->delivery_status = 'delivered';
        $order->payment_status = 'paid';

        $order->save();
        return redirect()->back();
    }
}
