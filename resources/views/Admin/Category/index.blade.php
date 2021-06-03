@extends('admin.layouts.master')
@section("title","Category Management")
@section("content")
    <h1 class="page-header">Category Management</h1>
    <h3 class="sub-header">Category List</h3>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create New Category</a>
        </div>
        <form action="{{ route('admin.category') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="wanted"></label>
                <input type="text" class="form-control form-control-lg" name="wanted"
                       placeholder="Search category" value="{{ old('wanted') }}">
                <label for="sup_id">Sup Category</label>
                <select name="sup_id" id="sup_id" class="form-control">
                    <option value="">Select</option>
                    @foreach($sup_categories as $sup_category)
                        <option value="{{ $sup_category->id }}" {{ old('sup_id')==$sup_category->id ? 'selected' : ''}}>
                            {{ $sup_category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.category') }}" class="btn btn-primary">Clear</a>
        </form>
    </div>

    <div class="table-responsive">
        @include('layouts.Partials.alert')
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Sup Category</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Created At</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(count($list)==0)
                <tr>
                    <td colspan="7" class="text-center text-danger">No Records Found</td>
                </tr>
            @endif
            @foreach($list as $entry)
                    <tr>
                        <td>{{ $entry->id }}</td>
                        <td>{{ $entry->sup_category->name }}</td>
                        <td>{{ $entry->name }}</td>
                        <td>{{ $entry->slug }}</td>
                        <td>{{ $entry->created_at }}</td>
                        <td style="width: 100px">
                            <a href="{{ route('admin.category.update', $entry->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update">
                                <span class="fa fa-pencil"></span>
                            </a>
                            <a href="{{ route('admin.category.delete', $entry->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
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
