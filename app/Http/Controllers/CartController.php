<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Product;
use Cart;
use Validator;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function Index(){
        return view("cart");
    }

    public function Add(){
        $product=Product::find(request('id'));
        $cartItem=Cart::add(array('id'=>$product->id, 'name'=>$product->name, 'qty'=>1, 'price'=>$product->price, ['slug' => $product->slug]));

        if(auth()->check()){
            $active_cart_id=session('active_cart_id');
            if(!isset($active_cart_id)){
                $active_cart=\App\Models\Cart::create([
                    'user_id'=>auth()->id()
                ]);
                $active_cart_id= $active_cart->id;
                session()->put('active_cart_id',$active_cart_id);
            }
            CartProduct::UpdateOrCreate(
                ['cart_id'=>$active_cart_id, 'product_id'=>$product->id],
                ['quantity'=>$cartItem->qty, 'price'=>$product->price, 'status'=>'Waiting']
            );
        }
        return redirect()->route('cart')
            ->with('message','Product added to cart')
            ->with('message_type','success');

    }

    public function Delete($rowId){

        if(auth()->check()){
            $active_cart_id=session('active_cart_id');
            $cartItem=Cart::get($rowId);
            CartProduct::where('cart_id',$active_cart_id)->where('product_id',$cartItem->id)
            ->delete();
        }

        Cart::remove($rowId);
        return redirect()->route('cart')
            ->with('message','Product deleted from cart')
            ->with('message_type','success');

    }

    public function Empty(){
        if(auth()->check()){
            $active_cart_id=session('active_cart_id');
            CartProduct::where('cart_id',$active_cart_id)->delete();
        }
        Cart::destroy();
        return redirect()->route('cart')
            ->with('message','Basket has been emptied')
            ->with('message_type','success');
    }

    public function Update($rowId){
        $validator=Validator::make(request()->all(),[
            'quantity'=>'required|numeric|between:0,5'
        ]);

        if($validator->fails()){
            session()->flash('message_type', 'danger');
            session()->flash('message','Quantity must be between 1 and 5.');
            return response()->json(['success'=>false]);
        }

        if(auth()->check()){
            $active_cart_id=session('active_cart_id');
            $cartItem=Cart::get($rowId);
            if(request('quantity')==0){
                CartProduct::where('cart_id',$active_cart_id)
                    ->where('product_id',$cartItem->id)
                    ->delete();
            }
            else{
                CartProduct::where('cart_id',$active_cart_id)
                    ->where('product_id',$cartItem->id)
                    ->update(['quantity'=>request('quantity')]);
            }
        }

        Cart::update($rowId, request('quantity'));

        session()->flash('message_type', 'success');
        session()->flash('message','Basket is updated');

        return response()->json(['success'=>true]);

    }
}
