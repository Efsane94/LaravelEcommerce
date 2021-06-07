<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Cart;
class PaymentController extends Controller
{
    public function Index(){

        if(!auth()->check()){
            return  redirect()->route('user.login')
                    ->with('message','To pay you need to login or register')
                    ->with('message_type','info');
        }
        else if(count(Cart::content())==0)
        {
                return redirect()->route('home')
                    ->with('message','To pay must be need products in your cart')
                    ->with('message_type','info');;
        }

        $user_detail=auth()->user()->detail;

        return view("payment", compact('user_detail'));
    }

    public function Repayment()
    {
        $order=request()->all();
        $order['cart_id']=session('active_cart_id');
        $order['card']='Garanty';
        $order['installment_count']=1;
        $order['status']='Your order has been received';
        $order['order_total']=Cart::subtotal();

        Order::create($order);
        Cart::destroy();
        session()->forget('active_cart_id');

        return redirect()->route('orders')
            ->with('message_type','success')
            ->with('message','Your order has been registered');
    }
}
