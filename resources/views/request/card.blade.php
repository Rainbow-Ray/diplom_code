@extends('List')
@section('title')
    <title>Запрос на закупку</title>
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
    Запрос на закупку
@endsection

@section('addButton')
    <a class="addButtonLink" href="{{ url($rootURL . '/create', []) }}">
        <button class="addButton beautyButton">
            Добавить запрос
        </button>
    </a>
@endsection

@section('dictCard')
    @foreach ($items as $item)
        <div class="card @if ($item->isUrgent) urgent @endif ">
                <div class="itemInfo info5">
                    <span class="cardLabel">Номер:</span>
                    <span class="cardData">{{ $item->number }}</span>
                    <span class="cardLabel">Дата создания:</span>
                    <span class="cardData">{{ $item->dateCreated }}</span>
                    <span class="cardLabel isDone">Выполнен:</span>
                    @if ($item->isDone)
                        <p class="cardData done isDone">✓</p>
                    @else
                        <p class="cardData  isDone">❌</p>
                    @endif

                    <span class="cardLabel">Разместил:</span>
                    <span class="cardData">
                        {{ $item->worker->surname }}
                        {{ $item->worker->name }}
                        {{ $item->worker->patronym }}

                    </span>


                </div>
            <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">
                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
            </a>

            {{-- <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                <button>Редактировать</button>
            </a> --}}


            <div class="orderDetailLabel closed">
                <span class="buttonDetail"></span>

                <div class="orderDetail">
                    @foreach ($item->rows as $row)
                        <div class="itemInfo orderInfo">
                            <span class="cardLabel">Материал/Оборудование:</span>
                            <span class="cardData">{{ $row->item() }}</span>
                            <span class="cardLabel">Кол-во:</span>
                            <span class="cardData">{{ $row->count }}</span>
                            <span class="cardLabel">Ед. изм.:</span>
                            @if(!is_null($row->mat_id))
                                                        <span class="cardData">{{ $row->material()->ei->name }}</span>

                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endsection
