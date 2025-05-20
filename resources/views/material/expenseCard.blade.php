@extends('List')
@section('title')
    <title>Расход материалов</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection
@section('header')
    Расход материалов
@endsection


@section('addButton')
    <a class="right" href="{{ url('material/exp', []) }}">
        <button class="addButton beautyButton">Расход материала</button>
    </a>
@endsection

@section('dictCard')
    <x-material-expense :items="$items" />
@endsection
