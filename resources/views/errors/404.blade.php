@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            <h1>404</h1>
            <h2>Axtardiginiz Sehife Tapilmadi.</h2>
            <a href="{{ route('home') }}" class="btn btn-primary">Back Home Page</a>
        </div>
    </div>
@endsection
