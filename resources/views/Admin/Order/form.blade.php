@extends('admin.layouts.master')
@section("title","Order Management")
@section("content")
    <h1 class="page-header">Orders</h1>
    <form action="{{ route('admin.order.save', $order->id) }}" method="post">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ @$order->id>0 ? 'Update' : 'Create' }}
            </button>
        </div>
        <h2 class="sub-header">Order {{ $order->id>0 ? 'Update' : 'Create' }}</h2>
        @include('layouts.Partials.errors')
        @include('layouts.Partials.alert')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username"
                           placeholder="User Name" value="{{old('name',$order->username)}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone"
                           placeholder="Phone" value="{{old('phone',$order->phone)}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address"
                           placeholder="Address" value="{{old('address',$order->address)}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option {{ old('status', $order->status)=='Payment Confirmed' ? 'selected' : '' }}>
                            Payment Confirmed
                        </option>
                        <option {{ old('status', $order->status)=='Order has been received' ?
                                'selected' : '' }}>
                            Order has been received</option>
                        <option {{ old('status', $order->status)=='Order has been shipped' ?
                                'selected' : '' }}>
                            Order has been shipped</option>
                        <option {{ old('status', $order->status)=='Order completed' ?
                                'selected' : '' }}>
                            Order completed</option>
                    </select>
                </div>
            </div>
        </div>
    </form>

    <h3>Order (O-{{$order->id}})</h3>
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
@endsection
