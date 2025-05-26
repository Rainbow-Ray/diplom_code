@extends('List')

@section('title')
    <title>Квитанция</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
    Квитанция №{{ $item->number }}
@endsection
@section('addButton')
@endsection

@section('dictCard')
    <div class="receiptForm receiptData">
        <div class="start1 end4 underline">
            <span class="cardLabel">ФИО:</span>
            <span class="cardData">{{ $item->customer->surname }} {{ $item->customer->name }} {{ $item->customer->patronym }}

                // {{ $item->customer->phone }}
            </span>
        </div>

        <div class="start1  underline">
            <span class="cardLabel">Изделие:</span>
            <span class="cardData">{{ $item->item }}</span>

        </div>
        <div class="start2 end4  underline">
            <span class="cardLabel">Количество:</span>
            <span class="cardData">{{ $item->order->count }}</span>

        </div>

        <div class="start1 end4 underline">
            <span class="cardLabel">Услуга:</span>
            <span class="cardData">{{ $item->order->service->name }}</span>

        </div>
        <div class="start1 underline">
            <span class="cardLabel">Пред. стоимость:</span>

            @if ($item->costPred > 0)
                <span class="cardData">{{ $item->costPred }}</span>
            @else
                <span class="cardData">0</span>
            @endif
            <span>руб.</span>
        </div>
        <div class="start2  underline">
            <span class="cardLabel">Доплата:</span>

            @if ($item->costAdd > 0)
                <span class="cardData">{{ $item->costAdd }}</span>
            @else
                <span class="cardData">0</span>
            @endif
            <span>руб.</span>

        </div>
        <div class="start3 underline">
            <span class="cardLabel">Дата приема:</span>
            <span class="cardData">{{ $item->dateIn() }}</span>


        </div>
        <div class="start1 underline">
            <span class="cardLabel">Стоимость ремонта:</span>
            @if ($item->cost > 0)
                <span class="cardData">{{ $item->cost }}</span>
            @else
                <span class="cardData">{{ $item->costPred }}</span>
            @endif

            <span>руб.</span>


        </div>
        <div class="  underline">
            <span class="cardLabel">Пред. дата получения:</span>
            <span class="cardData">{{ $item->datePlan() }}</span>


        </div>
        <div class="start3 end4 underline">
            <span class="cardLabel">Дата получения:</span>
            @if(is_null( $item->dateOut))
            <span class="cardData"></span>
            @else
            <span class="cardData">{{ $item->dateOut() }}</span>
            @endif

        </div>
        <div class="start1 end3 underline">
            <span class="cardLabel">Приемщик:</span>
            <span class="cardData">{{ $item->worker->surname }} {{ $item->worker->name }}
                {{ $item->worker->patronym }} {{ $item->worker->job->name }}
            </span>

        </div>
        <div class="start3 end4 underline ">
            <span class="cardLabel">Примечание:</span>
            <span class="cardData">{{ $item->note }}</span>

        </div>
        <div class="col1-2">

            @if ($item->order->isUrgent)
                <span class="cardLabel">Срочный заказ:</span>
                <span class="cardData done isDone">✓</span>
            @endif

        </div>

        <div class="start1 underline">
            <span class="cardLabel">Оплачено на данный момент:</span>
            @if ($item->sumNow() > 0)
                <span class="cardData">{{$item->sumNow()}} руб.</span>
            @else
                <span class="cardData">0 руб.</span>
            @endif
        </div>
                <div class=" underline">
            @if ($item->isPaid)
                <span class="cardData isDone done">Оплачено</span>
            @else
                <span class="cardData notDone isDone">Нет оплаты</span>
            @endif
        </div>

        
        <a href="{{ url('receipt/' . strval($item->id) . '/edit', []) }}" class="start3 end4 ">
            <button class="addButton beautyButton right">Редактировать</button>
        </a>

    </div>

    <div class="receiptData">
        <h3 class="col1-4">Изделий готово:</h3>
        <x-order-card :order="$item->order" />
        <h3 class="col1-4">Выдачи заказа:</h3>

        <x-order-out :order="$item->order" class="col1-2" />

            <a href="{{ url('receipt/' . strval($item->id) . '/hand_over', []) }}">
            <button class="addButton beautyButton">Выдать</button>
        </a>

        <h3 class="col1-4">Оплата:</h3>

        <x-income-row :income="$item->income" class="col1-2" />

    </div>

    <form action="{{ url('/receipt/' . $item->id . '/done') }}" method="POST">
        @csrf
        <input type="submit" class="addButton beautyButton rstart11 danger" name='done' value="Закрыть квитанцию">
    </form>
@endsection
