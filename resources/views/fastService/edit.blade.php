@extends('index')

@section('title')
    <title>Редактировать быструю услугу</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/material/materialExpense.js') }}" type="module"></script>
    <script src=" {{ asset('assets/js/payment/paymentScripts.js') }}" type="module"></script>
    <script src=" {{ asset('assets/js/fastService/countSum.js') }}"></script>

    <script></script>
@endsection
@section('main')
    <form action="{{ url($rootURL.'/'.$item->id) }}" method="POST">
        @csrf
        @method('Put')
        <h2 class="end7">Быстрая услуга</h2>

        <div class="labelTop">
            <label for="date">Номер:</label>
            <input type="text" name="number" id="number" value="{{ $item->number}}" required>
        </div>

        <div class="labelTop">
            <label for="date">Дата:</label>
            <input type="date" name="date" id="date" value="{{ $item->date }}" required>
        </div>

        <div class="labelTop start1 end4">
            <label for="service">Вид ремонта(услуги):</label>

            <select id="service" name="service">
                @foreach ($services as $service)
                    @if ($service->id == $item->service_id)
                        <option value="{{ $service->id }}" cost="{{ $service->cost }}" selected>
                        @else
                        <option value="{{ $service->id }}" cost="{{ $service->cost }}">
                    @endif
                    {{ $service->name . ' // ' . $service->cost }} руб.
                    </option>
                @endforeach
            </select>
        </div>

        <div class="labelTop">
            <label for="count">Количество:</label>
            <input type="number" name="count" id="count" min="1" value="{{ $item->count }}" required>
        </div>

        <div class="labelTop price start5">
            <label for="cost">Стоимость:</label>
            <input type="money" name="cost" id="cost" value="{{ old('cost') }}">
            <span>руб.</span>
        </div>


        <div id="incomeEdit" class="start1 end4 col3">
            <input type="text" id="incomeId" value="{{$item->income_id}}" class="hide">
            <div class="labelTop">
                <span class="cardLabel start1 end3">Источник</span>
                <span class="cardData start1 end3" id="incSource"></span>
            </div>
            <div class="labelTop">
                <span class="cardLabel start1 end3" >Дата</span>
                <span class="cardData start1 end3" id="incDate"></span>
            </div>
            <div class="labelTop right">
                <span class="cardLabel start1 end3">Сумма, руб.</span>
                <span class="cardData start1 end3" id="incAmount"></span>
            </div>

        </div>

                <a class="right" target='_blank' href="{{ url('income/'.$item->income_id.'/edit', []) }}">
                <input type="button" class="addButton beautyButton" value="Редактировать доход">
            </a>

        <input class="beautyButton submitButton end7 rstart11" type="submit" value="Отправить">
    </form>
@endsection
