@extends('admin.layouts.master')
@section("title","Product Management")
@section("content")
    <h1 class="page-header">Product Management</h1>
    <h3 class="sub-header">Product List</h3>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Create New Product</a>
        </div>
        <form action="{{ route('admin.product') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="wanted"></label>
                <input type="text" class="form-control form-control-lg" name="wanted"
                       placeholder="Search product" value="{{ old('wanted') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.product') }}" class="btn btn-primary">Clear</a>
        </form>
    </div>

    <div class="table-responsive">
        @include('layouts.Partials.alert')
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Slug</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Created At</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(count($list)==0)
                <tr>
                    <td colspan="7" class="text-center text-danger">No Product Found</td>
                </tr>
            @endif
            @foreach($list as $entry)
                    <tr>
                        <td>{{ $entry->id }}</td>
                        <td>
                            <img src="{{$entry->detail->product_img!=null ? asset('/uploads/products/' .$entry->detail->product_img) :
                                'http://via.placeholder.com/400x400?text=ProductImage'}}" alt="" style="width: 120px; height: 80px;">
                        </td>
                        <td>{{ $entry->slug }}</td>
                        <td>{{ $entry->name }}</td>
                        <td>{{ $entry->price }}</td>
                        <td>{{ $entry->created_at }}</td>
                        <td style="width: 100px">
                            <a href="{{ route('admin.product.update', $entry->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update">
                                <span class="fa fa-pencil"></span>
                            </a>
                            <a href="{{ route('admin.product.delete', $entry->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
                               onclick="return confirm('Are you sure?')">
                                <span class="fa fa-trash"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
    </div>
@endsection
