<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        if(!empty(request('wanted')))
        {
            //Search buttonuna basilan zaman bunu yazmayanda input icerisindeki axtarilan soz silinirdi.
            //Bunu ona gore yaziriq ki,flash() session icinde hemin sozu saxlayir ve buttona basilanda
            //axtarilan soz itmir.
            request()->flash();
            $wanted=request('wanted');
            $list=Order::with('cart.user')
                ->where('username','like', "%$wanted%")
                ->orwhere('id','like',"$wanted")
                ->orderbydesc('id')
                ->paginate(8)
                ->appends('wanted',$wanted);
        }
        else{
            $list=Order::with('cart.user')
                ->orderbydesc('id')
                ->paginate(8);
        }

        return view('admin.order.index', compact('list'));
    }

    public function form($id = 0)
    {
        if($id>0){
            $order=Order::with('cart.cart_products.product')->find($id);
        }

        return view('admin.order.form', compact('order'));
    }

    public function save($id = 0)
    {
        //Xanalar doludurmu deye yoxlayiriq...
        $this->validate(request(),[
            'username'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'status'=>'required'
        ]);
        $data=request()->only('username','address','phone','status');

        if($id>0){
            $order=Order::where('id',$id)->firstOrFail();
            $order->update($data);
        }

        return redirect()->route('admin.order.update',$order->id)
            ->with('message_type','success')
            ->with('message','Order has been updated.');

    }

    public function delete($id){
        Order::destroy($id);

        return redirect()->route('admin.order')
            ->with('message_type','success')
            ->with('message','Order has been deleted.');
    }
}
