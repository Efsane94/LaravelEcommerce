@extends('admin.layouts.master')
@section("title","Order Management")
@section("content")
    <h1 class="page-header">Order Management</h1>
    <h3 class="sub-header">Order List</h3>
    <div class="well">
        <form action="{{ route('admin.order') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="wanted"></label>
                <input type="text" class="form-control form-control-lg" name="wanted"
                       placeholder="Search order" value="{{ old('wanted') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.order') }}" class="btn btn-primary">Clear</a>
        </form>
    </div>

    <div class="table-responsive">
        @include('layouts.Partials.alert')
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Order number</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
                <th>Order date</th>
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
                        <td>O- {{ $entry->id }}</td>
                        <td>{{ $entry->cart->user->username }}</td>
                        <td>{{ $entry->order_total * ((100+config('cart.tax')) / 100) }} ₺</td>
                        <td>{{ $entry->status }}</td>
                        <td>{{ $entry->created_at }}</td>
                        <td style="width: 100px">
                            <a href="{{ route('admin.order.update', $entry->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update">
                                <span class="fa fa-pencil"></span>
                            </a>
                            <a href="{{ route('admin.order.delete', $entry->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
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
