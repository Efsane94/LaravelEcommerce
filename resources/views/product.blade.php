@extends('layouts.master')
@section ('title',$product->name)
@section ('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
{{--            database-de tekrarlanma varsa, yeni bir kategoriyaya bir mehsul 2 defe elave olunubsa distinct() onlardan 1-ni goturur.--}}
            @foreach($categories as $category)
            <li><a href="{{route('category', $category->slug )}}">{{ $category->name }}</a></li>
            @endforeach
            <li class="active"><a href="#">{{ $product->name }}</a></li>
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                    <img src="http://via.placeholder.com/400x300?text=ProductImage">
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://via.placeholder.com/60x60?text=ProductImage"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://via.placeholder.com/60x60?text=ProductImage"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://via.placeholder.com/60x60?text=ProductImage"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>{{ $product->name }}</h1>
                    <p class="price">{{ $product->price }} ₺</p>
                    <form action="{{ route('cart.add') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="submit" class="btn btn-theme" value="Add To Cart">
                    </form>
                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">Ürün Açıklaması</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Yorumlar</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">{{ $product->details }}</div>
                    <div role="tabpanel" class="tab-pane" id="t2">Yorum yoxdur.</div>
                </div>
            </div>

        </div>
    </div>
@endsection
