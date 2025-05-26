@extends('index')

@section('title')
    <title>Новая быстрая услуга</title>
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
    <form action="{{ url($rootURL) }}" method="POST">
        @csrf
        <h2 class="end7">Быстрая услуга</h2>

        <div class="labelTop">
            <label for="date">Номер:</label>
            <input type="text" name="number" id="number" value="{{ $number}}" required>
        </div>

        <div class="labelTop">
            <label for="date">Дата:</label>
            <input type="date" name="date" id="date" value="{{ date('Y-m-d', time()) }}" required>
        </div>

        <div class="labelTop start1 end4">
            <label for="service">Вид ремонта(услуги):</label>

            <select id="service" name="service">
                @foreach ($services as $service)
                    @if ($service->id == old('service'))
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
            <input type="number" name="count" id="count" min="1" value="{{ old('count', 1) }}" required>
        </div>

        <div class="labelTop price start5">
            <label for="cost">Стоимость:</label>
            <input type="money" name="cost" id="cost" value="{{ old('cost') }}">
            <span>руб.</span>
        </div>


        <div class="divPayment">
            <div>
                <input type="radio" name="payment" id="nal" value="1" checked>
                <label for="nal">Наличный расчет</label>
            </div>
            <div>
                <input type="radio" name="payment" id="kassa" value="2">
                <label for="kassa">Безналичный расчет</label>
            </div>
            <div class="divPaymentMethod divNal">
                <label for="payNal">Сумма</label>
                <input type="money" name="amount" id="payNal">
                <span> руб.</span>
            </div>
            <div class="divPaymentMethod divNal">
                <label for="payNalNum">Номер чека</label>
                <input type="text" name="payNumber" id="payNalNum">
            </div>
            <div class="divPaymentMethod divKassa">
                <table>
                    <thead>
                        <tr>
                            <th class="checkDate">Время</th>
                            <th class="checkAmount">Сумма</th>
                            <th class="checkNumber">Номер</th>
                        </tr>
                    </thead>
                    <tbody class="tbodyChecks">
                    </tbody>
                </table>
            </div>
        </div>

                <a class="right" target='_blank' href="{{ url('material/exp', []) }}">
                <input type="button" class="addButton beautyButton" value="Расход материала">
            </a>

        <input class="beautyButton submitButton end7 rstart11" type="submit" value="Отправить">
    </form>
@endsection
