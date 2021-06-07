@extends('layouts.master')
@section('title','Order')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Orders</h2>
            @if($orders->count()==0)
            <p>Don't have any orders yet.</p>
                @else

            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Order number</th>
                    <th>Total</th>
                    <th>Product Count</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_total * ((100+config('cart.tax')) /100)}}</td>
                    <td>{{ $order->cart->cart_product_count() }}</td>
                    <td>{{ $order->status }}</td>
                    <td><a href="{{ route('order',$order->id) }}" class="btn btn-sm btn-success">Detail</a></td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
@endsection
