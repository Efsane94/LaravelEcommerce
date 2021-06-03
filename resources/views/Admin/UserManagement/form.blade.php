@extends('admin.layouts.master')
@section("title","User Management")
@section("content")
    <h1 class="page-header"></h1>
    <form action="{{ route('admin.usermanagement.save', @$user->id) }}" method="post">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ @$user->id>0 ? 'Update' : 'Create' }}
            </button>
        </div>
        <h2 class="sub-header">User {{ @$user->id>0 ? 'Update' : 'Create' }}</h2>
        @include('layouts.Partials.errors')
        @include('layouts.Partials.alert')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{old('username',$user->username)}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email',$user->email)}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ @$user->id>0 ? old('address',$user->detail->address) : ''}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" value="{{ @$user->id>0 ? old('phone',$user->detail->phone) : ''}}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label for="is_active">
{{--                Eger istifadeci checkbox-u deyiserse ve diger xanalardan her hansi birinde validation--}}
{{--                sehvi olarsa update buttona basandan sonra is_active deyeri evvelki deyeri goturur--}}
{{--                yene. Ona gore biz burda hidden inputunun icinde evvelce sifirlayiriq deyeri,--}}
{{--                sonra yeniden gelen deyeri update edirik.--}}
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" {{ old('is_active',$user->is_active) ? 'checked': '' }}> Is Active
            </label>
        </div>
        <div class="checkbox">
            <label for="is_admin">
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" name="is_admin" id="is_admin" {{ old('is_admin',$user->is_admin) ? 'checked': '' }}> Is Admin
            </label>
        </div>

    </form>
@endsection
