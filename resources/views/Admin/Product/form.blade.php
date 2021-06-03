@extends('admin.layouts.master')
@section("title","Product Management")
@section("content")
    <h1 class="page-header">Products</h1>
    <form action="{{ route('admin.product.save', @$product->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ @$product->id>0 ? 'Update' : 'Create' }}
            </button>
        </div>
        <h2 class="sub-header">Product {{ $product->id>0 ? 'Update' : 'Create' }}</h2>
        @include('layouts.Partials.errors')
        @include('layouts.Partials.alert')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder="Product Name" value="{{old('name',$product->name)}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="original_slug" value="{{old('slug',$product->slug)}}">
                    <input type="text" class="form-control" name="slug" id="slug"
                           placeholder="Slug" value="{{old('slug',$product->slug)}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="details">Details</label>
                    <textarea class="form-control" name="details" id="details">
                        {{ old('details',$product->details) }}
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" id="price"
                           placeholder="Price" value="{{old('price',$product->price)}}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="show_slider" value="0">
                <input type="checkbox" name="show_slider" id="show_slider" value="1"
                    {{ old('show_slider',$product->detail->show_slider) ? 'checked': '' }}>
                Show Slider
            </label>
            <label>
                <input type="hidden" name="opportunity_day" value="0">
                <input type="checkbox" name="opportunity_day" id="opportunity_day" value="1"
                    {{ old('opportunity_day',$product->detail->opportunity_day) ? 'checked': '' }}>
                Opportunity of days
            </label>
            <label>
                <input type="hidden" name="stand_out" value="0">
                <input type="checkbox" name="stand_out" id="stand_out" value="1"
                    {{ old('stand_out',$product->detail->stand_out) ? 'checked': '' }}>
                Stand Out
            </label>
            <label>
                <input type="hidden" name="selling_lot" value="0">
                <input type="checkbox" name="selling_lot" id="selling_lot" value="1"
                    {{ old('selling_lot',$product->detail->selling_lot) ? 'checked': '' }}>
                Selling Lots
            </label>
            <label>
                <input type="hidden" name="show_sales" value="0">
                <input type="checkbox" name="show_sales" id="show_sales" value="1"
                    {{ old('show_sales',$product->detail->show_sales) ? 'checked': '' }}>
                Sales
            </label>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cats">Categories</label>
                    <select name="categories[]" id="categories" class="form-control"  multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ collect(old('categories',$product_categories))->contains($category->id) ? 'selected' : ''}}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                @if($product->detail->product_img!=null)
                    <img src="/uploads/products/{{ $product->detail->product_img }}" alt=""
                    style="height: 100px; margin-right: 20px;" class="thumbnail pull-left">
                @endif
                <label for="product_img">Image</label>
                <input type="file" id="product_img" name="product_img">
            </div>
        </div>
    </form>
@endsection

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#categories').select2({
                placeholder:'Select Categories'
            });
        });

        var options={
            uiColor:'#f4645f',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
            CKEDITOR.replace( 'details',options );

    </script>

@endsection
