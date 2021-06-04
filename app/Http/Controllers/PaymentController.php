<?php

namespace App\Http\Controllers;

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

//    public function Pay(){
//        $order=request()->all();
//        $order['cart_id']=session('active_cart_id');
//        $order['bank']='Garanty';
//        $order['installment_number']=1;
//        $order['status']='Your order has been received';
//        $order['total']=Cart::subtotal();
//
//        return view();
//    }
}
