@extends('List')
@section('title')
    <title>Закупка</title>
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
Закупка
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Добавить закупку
    </button>
</a>
@endsection

@section('dictCard')
    @foreach ($items as $item)
        <div class="card">
            <div>
                    <div class="itemInfo orderInfo">
                        <span class="cardLabel">Номер:</span>
                        <span class="cardData">{{ $item->number }}</span>
                        <span class="cardLabel">Дата создания:</span>
                        <span class="cardData">{{ $item->date }}</span>
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
                        <span class="cardLabel">Цена:</span>
                        <span class="cardData">{{ $row->price }}</span>
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
