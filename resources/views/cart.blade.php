@extends('layouts.master')
@section ('title','Cart')
@section ('content')

    <div class="container">
        <div class="bg-content">
            @include('layouts.Partials.alert')
            <h2>Cart</h2>
            @if(count(Cart::content())>0)
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th>Product </th>
                        <th>Name </th>
                        <th>Price</th>
                        <th class="text-center">Quantity</th>
                        <th>Total</th>
                    </tr>
                    @foreach(Cart::content() as $cartItem)
                        <tr>
                            <td style="width:120px;">
                                <img src="http://via.placeholder.com/120x100?text=ProductImage" style="width:120px; height:100px;">
                            </td>
                            <td>
{{--                                <a href="{{ route('product', $cartItem->slug)}}">--}}
                                    {{ $cartItem->name }}
{{--                                </a>--}}
                                <form action="{{ route('cart.delete', $cartItem->rowId) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-xs" value="Delete">
                                </form>
                            </td>
                            <td>{{ $cartItem->price }} ₺</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-xs btn-default quantity-decrease"
                                   data-id="{{ $cartItem->rowId }}"
                                   data-quantity="{{ $cartItem->qty-1 }}">-
                                </a>
                                <span style="padding: 10px 20px">{{ $cartItem->qty }}</span>
                                <a href="#" class="btn btn-xs btn-default quantity-increase"
                                   data-id="{{ $cartItem->rowId }}"
                                   data-quantity="{{ $cartItem->qty+1 }}">+
                                </a>
                            </td>
                            <td>{{ $cartItem->subtotal }} ₺</td>
                            <td>
                                <a href="#">Sil</a>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <th colspan="4" class="text-right">Total</th>
                        <th></th>
                        <td class="text-right">{{ Cart::subtotal() }} ₺</td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Tax</th>
                        <th></th>
                        <td class="text-right">{{ Cart::tax() }} %</td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Grand Total</th>
                        <th></th>
                        <td class="text-right">{{ Cart::total() }} ₺</td>
                    </tr>
                </table>
                <div>
                    <form action="{{ route('cart.empty') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-info pull-left" value="Empty the Basket">
                    </form>
                    <a href="{{ route('payment') }}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                </div>
            @else
                <p>There are no items in your cart</p>
            @endif
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(function (){
            $('.quantity-increase, .quantity-decrease').on('click',function (){
                var id=$(this).attr('data-id');
                var qty=$(this).attr('data-quantity');

                $.ajax({
                    type:'Patch',
                    url:'{{ url('cart/update') }}/' + id,
                    data:{quantity: qty},
                    success:function (){
                        window.location.href='{{ route('cart') }}'
                    }
                });
            });
        });
    </script>
@endsection
