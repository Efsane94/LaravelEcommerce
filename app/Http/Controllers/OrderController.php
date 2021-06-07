<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function Index(){
        $orders=Order::with('cart')
            ->whereHas('cart',function ($query){
                $query->where('user_id',auth()->id());
            })
            ->orderbydesc('created_at')->get();

        return view("orders",compact('orders'));
    }

    public function Details($id){
        $order=Order::with('cart.cart_products.product')
            ->whereHas('cart',function ($query){
                $query->where('user_id',auth()->id());
            })->where('order.id',$id)->firstOrFail();

        return view("orderdetails",compact('order'));
    }

}
