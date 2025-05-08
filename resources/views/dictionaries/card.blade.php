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
        Добавить
    </button>
</a>
@endsection


@section('dictCard')


@foreach ($items as $item)
<div class="card">
    <div>

        <p class="cardLabel">Название:</p>
        <p class="cardData">{{$item->name}}</p>
    

    </div>
    <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
        <button>Редактировать</button>
        </a>


</div>
@endforeach
@endsection
