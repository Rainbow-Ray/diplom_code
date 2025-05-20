@extends('index')

@section('title')
    <title>{{$title}}</title>
@endsection

@section('main')

<form action="{{$url}}" method="POST" target="_blank">
    <h2 class="start1 end7">{{$title}}</h2>
    @csrf
    <div class="labelTop start1 end4">
    <x-period class="" />
    </div>
    <input type="submit" class="beautyButton submitButton end7 rstart3" value="Сформировать">
</form>

@endsection
