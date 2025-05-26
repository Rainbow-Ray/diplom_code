@extends('index')
@section('title')
    <title>Оборудование</title>
@endsection
@section('header')
    Оборудование
@endsection

@section('addButton')
@endsection


@section('main')
    <div class="mainHeader">
        <h1>
            {{ $item->name }}
        </h1>
    </div>
    <div class="">

        <div class="itemInfo">

            <span class="cardLabel">Название:</span>
            <span class="cardData">{{ $item->name }}</span>
            <span class="cardLabel">Инвентарный номер:</span>
            <span class="cardData">{{ $item->number }}</span>
            <span class="cardLabel">Тип:</span>
            <span class="cardData">{{ $item->equipType->name }}</span>
            <span class="cardLabel">Состояние:</span>
            <span class="cardData">{{ $item->state() }}</span>
            <span class="cardLabel">Дата проверки:</span>
            <span class="cardData">{{ $item->dateCheck() }}</span>
            <span class="cardLabel">Периодичность проверки:</span>
            <span class="cardData">Раз в {{ $item->checkFreq }} дн.</span>



        </div>
        <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}" class="right">
            <button class="addButton beautyButton right">Редактировать</button>
        </a>
    </div>
    <div>
        <h2>Состояние оборудования</h2>

        <table>
            <thead>
                <th>Дата</th>
                <th>Состояние</th>
                <th></th>
            </thead>
            <tbody>
                        @foreach($item->states() as $c)

                <tr>

<td> {{$c->date}}</td>
<td> {{$c->state->name}}</td>
<td> <a href="{{ url('equip_check/' . strval($c->id) . '/edit', []) }}"><button>Редактировать</button></a></td>


                </tr>

                        @endforeach

            </tbody>
        </table>

    </div>

    <a href="{{ url('equip_check/' . strval($item->id) . '/create', []) }}"><button class="addButton beautyButton">Оценка
            оборудования</button></a>
@endsection
