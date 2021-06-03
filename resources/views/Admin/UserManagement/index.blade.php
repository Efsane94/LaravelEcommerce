@extends('admin.layouts.master')
@section("title","User Management")
@section("content")
    <h1 class="page-header">User Management</h1>
    <h3 class="sub-header">User List</h3>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.usermanagement.create') }}" class="btn btn-primary">Create New User</a>
        </div>
        <form action="{{ route('admin.usermanagement') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="wanted"></label>
                <input type="text" class="form-control form-control-lg" name="wanted"
                       placeholder="Search Username, Email" value="{{ old('wanted') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.usermanagement') }}" class="btn btn-primary">Clear</a>
        </form>
    </div>

    <div class="table-responsive">
        @include('layouts.Partials.alert')
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Is Active</th>
                <th>Is Admin</th>
                <th>Created At</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(count($list)==0)
                <tr>
                    <td colspan="7" class="text-center text-danger">Users Not Found</td>
                </tr>
            @endif
            @foreach($list as $entry)
            <tr>
                <td>{{ $entry->id }}</td>
                <td>{{ $entry->username }}</td>
                <td>{{ $entry->email }}</td>
                <td>
                    @if($entry->is_active)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-warning">Passive</span>
                    @endif
                </td>
                <td>
                    @if($entry->is_admin)
                        <span class="label label-success">Admin</span>
                    @else
                        <span class="label label-warning">User</span>
                    @endif
                </td>
                <td>{{ $entry->created_at }}</td>
                <td style="width: 100px">
                    <a href="{{ route('admin.usermanagement.update', $entry->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{ route('admin.usermanagement.delete', $entry->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
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
