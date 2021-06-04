@extends('layouts.master')
@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="active">Response</li>
        </ol>

        <div class="products bg-content">
            <div class="row">
                @if(count($products)==0)
                    <div class="col-md-12 text-center">
                        Product not found.
                    </div>
                @endif
                @foreach($products as $product)
                    <div class="col-md-3 product">
                        <a href="{{ route('product', $product->slug) }}">
                            <img src="http://via.placeholder.com/400x400?text=ProductImage" alt="{{ $product->name }}">
                        </a>
                        <p>
                            <a href="{{ route('product', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </p>
                        <p class="price">{{ $product->price }} ₺</p>
                    </div>
                @endforeach
            </div>
{{--            appends--> Axtarisda olan soze uygun productlar arasinda pagination eleyir. Appends yazilmadigi --}}
{{--            halda ise 1-ci page-de axtarisda olan soze uygun, ama ikinci sehifeye kecende artiq butun mehsullar--}}
{{--            arasinda pagination eleyir. ona gore Appends mutleqdi.--}}
            <div class="text-center">{{ $products->appends(['word'=>old('word')])->links('pagination::bootstrap-4') }}</div>
        </div>
    </div>
@endsection
