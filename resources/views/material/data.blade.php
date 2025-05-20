@extends('List')

@section('title')
    <title>{{ $item->name }}</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
    {{ $item->name }}
@endsection
@section('addButton')
@endsection


@section('dictCard')
    <div class="card receiptData">
        <div>
            <div class="itemInfo info5">
                <span class="cardLabel">Наименование:</span>
                <span class="cardData">{{ $item->name }}</span>
                <span class="cardLabel">Количество:</span>
                <span class="cardData">{{ $item->amount() }}</span>
                <span class="cardLabel">Ед. изм.:</span>
                <span class="cardData">{{ $item->ei->name }}</span>

                <span class="cardLabel">Тип:</span>
                <span class="cardData">{{ $item->type->name }}</span>
                <span class="cardLabel">Категория:</span>
                <span class="cardData">{{ $item->category->name }}</span>
            </div>
        </div>


    </div>
    <div class="receiptData">
        <h3>Закупки</h3>
        @foreach ($item->income() as $row)
            <div class="itemInfo orderInfo">
                <span class="cardLabel">Дата:</span>
                <span class="cardData">{{ $row['date'] }}</span>
                <span class="cardLabel">Кол-во:</span>
                <span class="cardData">{{ $row->count }}</span>
            </div>
        @endforeach
    </div>
    <div class="receiptData">
                <h3>Расход</h3>

        @foreach ($item->expense as $row)
            <div class="itemInfo orderInfo">
                <span class="cardLabel">Дата:</span>
                <span class="cardData">{{ $row->date }}</span>
                <span class="cardLabel">Кол-во:</span>
                <span class="cardData">{{ $row->amount }}</span>
            </div>
        @endforeach
    </div>
    <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
        <button class="beautyButton addButton rstart3 end7 right">Редактировать</button>
    </a>

@endsection
