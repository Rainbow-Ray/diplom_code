@extends('List')
@section('title')
    <title>Сотрудники</title>
@endsection
@section('header')
    Сотрудники
@endsection

@section('addButton')
    <a class="addButtonLink" href="{{ url($rootURL . '/create', []) }}">
        <button class="addButton">
            Добавить сотрудника
        </button>
    </a>
@endsection


@section('dictCard')
    @foreach ($items as $item)
        <div class="card">
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">
                    <div class="itemInfo receiptInfo">
                        <span class="cardLabel">ФИО:</span>
                        <p class="cardData">{{ $item->surname }} {{ $item->name }}
                            {{ $item->patronym }}</p>

                        <span class="cardLabel">Должность:</span>
                        <p class="cardData">{{ $item->job->name }}</p>

                        <span class="cardLabel">Телефон:</span>
                        <p class="cardData">{{ $item->phone }}</p>
                        <span class="cardLabel">email:</span>
                        <p class="cardData">{{ $item->email }}</p>
                    </div>

                    <div class="orderDetailLabel">
                        <span class="buttonDetail"></span>

                        <div class="orderDetail">
                            <div class="itemInfo orderInfo">
                                <span class="cardLabel">Паспорт:</span>
                                <span class="cardData">{{ $item->passSerie }}</span>
                                <span class="cardData">{{ $item->passNum }}</span>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                    <button>Редактировать</button>
                </a>
            </div>

        </div>
    @endforeach
@endsection
