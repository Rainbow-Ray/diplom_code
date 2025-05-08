@extends('List')
@section('title')
<title>{{$title}}</title>
@endsection
@section('header')
{{$title}}
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton">
        Добавить должность
    </button>
</a>
@endsection


@section('dictCard')
@foreach ($items as $item)
<div>
    <p>Название:</p>
    <p>{{$item->name}}</p>
    <p>Заработная плата:</p>
    <p>{{$item->salary}}</p>
    <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
        <button>Редактировать</button>
        </a>
</div>
<hr>
@endforeach
@endsection
