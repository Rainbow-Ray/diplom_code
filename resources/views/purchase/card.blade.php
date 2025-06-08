@extends('List')
@section('title')
    <title>Закупки</title>
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
Закупки
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Добавить закупку
    </button>
</a>
@endsection

@section('dictCard')

    <input type="date" class="filter" id="dateStart"
        value="{{ (new DateTime('yesterday', new DateTimeZone('Asia/Yekaterinburg')))->format('Y-m-d') }}">
    <input type="date" class="filter" id="dateEnd"
        value="{{ (new DateTime('now', new DateTimeZone('Asia/Yekaterinburg')))->format('Y-m-d') }}">

    <button class="filter mine" id="date">Показать за даты</button>
    <button class="filter allItems" id="all">Все</button>

    @foreach ($items as $item)
        <div class="card">
            <div>
                    <div class="itemInfo orderInfo">
                        <span class="cardLabel">Номер:</span>
                        <span class="cardData">{{ $item->number }}</span>
                        <span class="cardLabel">Дата создания:</span>
                        <span class="cardData">{{$item->date()}}</span>
                        <span class="cardLabel start3 end5">Сумма:</span>
                        <span class="cardData start3 end5">{{ $item->summ() }} руб.</span>
                    </div>
            </div>

            <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
            </a>


            <div class="orderDetailLabel closed">
                <span class="buttonDetail"></span>

                <div class="orderDetail">
                    @foreach($item->rows as $row)
                    <div class="itemInfo info5">
                        <span class="cardLabel">Материал/Оборудование:</span>
                        <span class="cardData">{{ $row->item() }}</span>
                        <span class="cardLabel">Кол-во:</span>
                        <span class="cardData">{{ $row->count }}</span>
                        <span class="cardLabel">Ед. изм.:</span>
                        <span class="cardData">{{ $row->material()->ei->name }}</span>
                        <span class="cardLabel start4 end6">Цена:</span>
                        <span class="cardData start4 end6">{{ $row->price }} руб.</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endsection



@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
