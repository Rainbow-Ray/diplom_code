@extends('index')

@section('title')
    <title>
        Главное меню
    </title>
@endsection



@section('main')
    <div class="mainHeader">
        <h1>Главное меню</h1>
    </div>
    <div class="mainBlock">
        <h2 class="start1 end3">Готовы к выдаче</h2>
        <div class="block header start1 end3">
            <span>Изделие</span>
            <span class="start2 end4">Клиент</span>
            <span class="start4 end6">Номер телефона</span>
        </div>

        @foreach ($receipt as $item)
            <a class="start1 end3" href="http://127.0.0.1:8000/receipt/{{ $item->id }}">
                <div class="block item">
                    <span>{{ $item->item }} </span>
                    <span class="start2 end4">{{ $item->surname }} {{ $item->name }} {{ $item->patronym }}</span>
                    <span class="start4 end6">{{ $item->phone }}</span>

                </div>

            </a>
            <a href="http://127.0.0.1:8000/receipt/{{ $item->receipt_id }}" class="start5">Квитанция</a>
        @endforeach
        @if (count($receipt) < 1)
            <span>Нет готовых к выдаче заказов</span>
        @endif
    </div>

    <div class="mainBlock">
        <h2 class="start1 end3">Заказы в работе</h2>
        <div class="block header start1 end3">
            <span>Изделие</span>
            <span>Дата принятия</span>
            <span>Дата выдачи</span>
            <span>Готово</span>
            <span></span>
        </div>
        @foreach ($order as $item)
            <a class="start1 end3" href="http://127.0.0.1:8000/order/{{ $item->id }}">
                <div class="block item">
                    <span>{{ $item->receipt->item }} </span>
                    <span>{{ $item->receipt->dateIn() }}</span>
                    <span>{{ $item->receipt->datePlan() }}</span>
                    <span>{{ $item->countDone }}</span>
                    <span>{{ $item->isUrgent() }}</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mainBlock">
        <h2 class="start1 end3">Оборудование в плохом состоянии или требующее проверки</h2>
        <div class="block header start1 end3">
            <span>Изделие</span>
            <span>Инвентарный номер</span>
            <span class="start3 end5">Дата последней проверки</span>
            <span>Состояние</span>
            <span>Частота проверки</span>
        </div>
        @foreach ($equip as $e)
            <a class="start1 end3" href="http://127.0.0.1:8000/equip/{{ $e->id }}">
                <div class="block item">
                    <span>{{ $e->name }} </span>
                    <span>{{ $e->number }} </span>
                    <span class="start3 end5">{{ $e->date() }}</span>
                    <span>{{ $e->state() }}</span>
                    <span>Раз в {{$e->checkFreq }} дн.</span>
                    <span></span>
                </div>
            </a>
        @endforeach
    </div>



    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
