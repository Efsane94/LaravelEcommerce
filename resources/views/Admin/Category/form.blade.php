@extends('admin.layouts.master')
@section("title","Category Management")
@section("content")
    <h1 class="page-header"></h1>
    <form action="{{ route('admin.category.save', @$category->id) }}" method="post">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ @$category->id>0 ? 'Update' : 'Create' }}
            </button>
        </div>
        <h2 class="sub-header">Category {{ $category->id>0 ? 'Update' : 'Create' }}</h2>
        @include('layouts.Partials.errors')
        @include('layouts.Partials.alert')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sup_categoryId">Sup Category</label>
                    <select name="sup_categoryId" id="sup_categoryId" class="form-control">
                        <option value="">Main Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="{{old('name',$category->name)}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug</label>
{{--                    Category Update edende kategoriyanin slug deyerini ozu ile muqayise edir deye--}}
{{--                    validation error verir. Onun qarsisini almaq ucun burda slug deyerini hidden --}}
{{--                    inputla gotururuk ve validationda yoxlayiriq, eger sug deyeri deyisilmirse--}}
{{--                    validation qoymuruq, deyisilirse validation add edirik.--}}
                    <input type="hidden" name="original_slug" value="{{old('slug',$category->slug)}}">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{old('slug',$category->slug)}}">
                </div>
            </div>
        </div>
    </form>
@endsection

