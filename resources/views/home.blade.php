@extends("layouts.master")
@section("title","Home")
@section("content")
    @include('layouts.Partials.alert')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>
                    <div class="list-group categories">

                        @foreach($categories as $category)
                        <a href="{{ route('category', $category->slug) }}" class="list-group-item">
                            <i class="fa fa-arrow-circle-o-right"></i>
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0; $i<count($slider_products); $i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ $i==0 ? 'active' : ''}}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($slider_products as $index=> $product)
                        <div class="item {{$index == 0 ? 'active' : ''}}">
                            <img src="http://via.placeholder.com/640x400?text=ProductImage" alt="...">
                            <div class="carousel-caption">
                                {{$product->name}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Opportunity Of The Day</div>
                    <div class="panel-body">
                        <a href="{{ route('product', $opp_day->slug) }}">
                            <img src="{{$opp_day->detail->product_img!=null ? asset('/uploads/products/' .$opp_day->detail->product_img) :
                                'http://via.placeholder.com/400x485?text=ProductImage'}}"
                                 style="min-width: 100%;" class="img-responsive">
                            {{ $opp_day->name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">??ne ????kan ??r??nler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($stand_out as $product)
                        <div class="col-md-3 product">
                            <a href="{{ route('product', $product->slug) }}">
                                <img src="{{$product->detail->product_img!=null ? asset('/uploads/products/' .$product->detail->product_img) :
                                'http://via.placeholder.com/400x400?text=ProductImage'}}"
                                     style="min-width: 100%;" class="img-responsive">
                            </a>
                            <p>
                                <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                            </p>
                            <p class="price">{{ $product->price }} ???</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">??ok Satan ??r??nler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($selling_lot as $product)
                            <div class="col-md-3 product">
                                <a href="{{ route('product', $product->slug) }}">
                                    <img src="{{$product->detail->product_img!=null ? asset('/uploads/products/' .$product->detail->product_img) :
                                'http://via.placeholder.com/400x400?text=ProductImage'}}"
                                         style="min-width: 100%;" class="img-responsive">
                                </a>
                                <p>
                                    <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                </p>
                                <p class="price">{{ $product->price }} ???</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">??ndirimli ??r??nler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($show_sales as $product)
                            <div class="col-md-3 product">
                                <a href="{{ route('product', $product->slug) }}">
                                    <img src="{{$product->detail->product_img!=null ? asset('/uploads/products/' .$product->detail->product_img) :
                                'http://via.placeholder.com/400x400?text=ProductImage'}}"
                                         style="min-width: 100%;" class="img-responsive">
                                </a>
                                <p>
                                    <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                </p>
                                <p class="price">{{ $product->price }} ???</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
