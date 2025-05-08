@extends('List')
@section('title')
    <title>Запрос на закупку</title>
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
Запрос на закупку
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Добавить запрос
    </button>
</a>
@endsection

@section('dictCard')
    @foreach ($items as $item)
        <div class="card">
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">
                    <div class="itemInfo orderInfo">
                        <span class="cardLabel">Дата создания:</span>
                        <span class="cardData">{{ $item->dateCreated }}</span>
                    </div>
                </a>
            </div>

            <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                <button>Редактировать</button>
            </a>


            <div class="orderDetailLabel">
                <span class="buttonDetail"></span>

                <div class="orderDetail">
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
            </div>
        </div>
    @endforeach
@endsection
