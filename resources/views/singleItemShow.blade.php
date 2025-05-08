@extends('index')
@include($view, ['item'=>$item])

@section('title')
@endsection

@section('main')
<div class="mainHeader">    
    <h1>    
    @yield('header')
    </h1>
</div>
    @yield('cardData')
    @yield('cardDetails')
@endsection
