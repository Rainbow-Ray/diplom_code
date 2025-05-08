@extends('List')

@section('title')
<title>Запрос</title>

<script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>

@endsection

@section('header')
Запрос на закупку
@endsection
@section('addButton')
@endsection


@section('dictCard')

<div class="card receiptData">
    <div>
            <div class="itemInfo orderInfo">
                <span class="cardLabel">Дата создания:</span>
                <span class="cardData">{{ $item->dateCreated }}</span>
                <span class="cardLabel">Дата закрытия:</span>
                <span class="cardData">{{ $item->dateClosed }}</span>
                <span class="cardLabel">Срочный:</span>
                <x-bool-span :cond="$item->isUrgent" class="" />
                <span class="cardLabel">Закрыт:</span>
                <x-bool-span :cond="$item->isDone" class="" />
                <span class="cardLabel">Создал:</span>
                <span class="cardData">{{ $item->worker->surname}}{{ $item->worker->name}}{{ $item->worker->patronym}}</span>
            </div>
    </div>

    <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
        <button>Редактировать</button>
    </a>

</div>
<div class="receiptData">
    @foreach($item->rows as $row)
    <div class="itemInfo orderInfo">
        <span class="cardLabel">Материал/Оборудование:</span>
        <span class="cardData">{{ $row->item() }}</span>
        <span class="cardLabel">Кол-во:</span>
        <span class="cardData">{{ $row->count }}</span>
        <span class="cardLabel">Ед. изм.:</span>
        <span class="cardData">{{ $row->ei->name }}</span>
    </div>
    @endforeach
</div>

@if(!$item->isDone)

<form action="{{url('/request/'.$item->id.'/done')}}" method="POST">
    @csrf
    <input type="submit" name='done' value="Закрыть запрос">
</form>

<a href="{{url('/request/'.$item->id.'/purchased')}}"><button>Добавить купленный товар</button></a>

@endif

@endsection