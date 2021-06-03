@extends('layouts.master')
@section ('title',$category->name)
@section ('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">{{ $category->name }}</a></li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $category->name }}</div>
                    <div class="panel-body">
                        @if(count($subCategories)>0)
                            <h3>Alt Kategoriler</h3>
                            <div class="list-group categories">
                                @foreach($subCategories as $sub)
                                    <a href="{{ route('category', $sub->slug ) }}" class="list-group-item"><i class="fa fa-television"></i> {{ $sub->name }}</a>
                                @endforeach
                            </div>
                        @else
                        Bu kategoriyada alt kategoriya yoxdur.
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    @if(count($products)>0)
                    Sırala
                    <a href="?order=sellinglot" class="btn btn-default">Çok Satanlar</a>
                    <a href="?order=newproducts" class="btn btn-default">Yeni Ürünler</a>
                    <hr>
                    @endif
                    @if(count($products)==0)
                       <div class="text-danger">Bu kategoriyaya aid mehsul daxil edilmeyib.</div>
                    @endif
                    <div class="row">
{{--                        img/product1.jpg--}}
                        @foreach($products as $product)
                        <div class="col-md-3 product">
                            <a href="{{ route('product', $product->slug ) }}"><img src="http://via.placeholder.com/400x400?text=ProductImage"></a>
                            <p><a href="{{ route('product', $product->slug ) }}">{{ $product->name }}</a></p>
                            <p class="price">{{ $product->price }} ₺</p>
                            <form action="{{ route('cart.add') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="submit" class="btn btn-theme" value="Add To Cart">
                            </form>
                        </div>
                        @endforeach
                    </div>
                    {{ request()->has('order') ? $products->appends(['order'=>request('order')])->links('pagination::bootstrap-4')
                    : $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

