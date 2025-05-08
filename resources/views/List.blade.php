@extends('index')

@section('title')
@yield('title')
@endsection



@section('main')
<div class="mainHeader">    
    <h1>    
    @yield('header')
    </h1>
    @yield('addButton')
</div>
    @yield('dictCard')
@endsection
