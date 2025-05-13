@extends('index')

@section('title')
    <title>Доходы и расходы предприятия за период</title>
@endsection

@section('scripts')
@endsection
@section('main')

<form action="{{url('report/incomes')}}" method="POST" target="_blank">
    @csrf
    <x-period class="" />
    <input type="submit" value="Сформировать">

</form>

@endsection
