@extends('layouts.master')
@section('title','Order')
@section('content')
    <div class="container">
        <div class="bg-content">
            <a href="{{ route('orders') }}" class="btn btn-primary btn-sm my-3">
                <i class="glyphicon glyphicon-arrow-left"></i>Go to back
            </a>
            <h2>Order (O-{{$order->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Product</th>
                    <th>Product Total</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                </tr>
                @foreach($order->cart->cart_products as $cart_product)
                <tr>
                    <td style="width:120px;">
                        <a href="{{ route('product', $cart_product->product->slug) }}">
                            <img src="{{$cart_product->product->detail->product_img!=null ?
                            asset('/uploads/products/'.$cart_product->product->detail->product_img) :
                            'http://via.placeholder.com/120x100?text=ProductImage'}}" style="width:120px; height: 100px;">
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('product', $cart_product->product->slug) }}">
                        {{ $cart_product->product->name }}
                        </a>
                    </td>
                    <td>{{ $cart_product->price }}</td>
                    <td>{{ $cart_product->quantity }}</td>
                    <td>{{ $cart_product->price * $cart_product->quantity }}</td>
                    <td>{{ $cart_product->status }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Subtotal</th>
                    <td colspan="2">{{ $order->order_total }} ₺</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Subtotal With Tax</th>
                    <td colspan="2">{{ $order->order_total  * ((100+config('cart.tax'))/100)}} ₺</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Order Status</th>
                    <td colspan="2">{{ $order->status }} </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
