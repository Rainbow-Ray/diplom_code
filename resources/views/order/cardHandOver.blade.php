@extends('index')

@section('title')
    <title>Выдать заказ</title>
@endsection

@section('scripts')
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/payment/paymentScripts.js') }}" type="module"></script>
@endsection
@section('main')
    <h2>Выдать заказ</h2>

    <div>
        <div class="itemInfo receiptInfo noPad">
            <span class="cardLabel start1 end3">ФИО:</span>
            <span class="cardData start1 end3">{{ $receipt->customer->surname }} {{ $receipt->customer->name }}
                {{ $receipt->customer->patronym }}</span>
            <span class="cardLabel">Изделие:</span>
            <span class="cardData">{{ $receipt->item }}</span>
            <span class="cardLabel">Услуга:</span>
            <span class="cardData">{{ $receipt->order->service->name }}</span>
            <span class="cardLabel">Дата приема:</span>
            <span class="cardData">{{ $receipt->dateIn() }}</span>
            <span class="cardLabel">Дата пред. выдачи:</span>
            <span class="cardData">{{ $receipt->datePlan() }}</span>
            <span class="cardLabel">Пред.стоимость:</span>
            <span class="cardData">{{ $receipt->costPred }} руб.</span>

        </div>
        @if ($receipt->isPaid)
            <span class="cardData done isDone">Оплачено</span>
        @else
            <span class="cardData notDone isDone">Нет оплаты</span>
        @endif

        <div class="orderCount">
            <span class="cardLabel">Кол-во по квитанции:</span>
            <span class="cardData">{{ $receipt->order->count }}</span>

            <span class="cardLabel ">Кол-во готово:</span>
            <span class="cardData">{{ $receipt->order->countDone }}</span>

            <span class="cardLabel ">Кол-во выдано:</span>
            <span class="cardData">{{ $receipt->order->handedOverCount() }}</span>
        </div>

        <form action="/{{ $rootURL }}/{{ $receipt->id }}/hand_over" method="POST" class="">
            @csrf
            <h2 class="start1 end7 noMargin">Новая выдача</h2>
            <div class="labelTop start1">
                <label for="count">Количество</label>
                <input type="number" max="{{ $receipt->order->count }}" min="0" value="1" name="count"
                    id="count">
            </div>

            <div class="labelTop start2">
                <label for="date">Дата</label>
                <input type="date" name="date" id="date" value="{{ date('Y-m-d', time()) }}">
            </div>

            <div class="labelTop start4 end7">
                <label for="note">Примечание</label>
                <input type="text" name="note" id="note">
            </div>
            <div class="">
                <label for="isFail">Брак</label>
                <input type="checkbox" name="isFail" id="isFail">
            </div>

            <div class="start2 end4">
                <label for="isHanded">Заказ выдан в полном объеме</label>
                <input type="checkbox" name="isHanded" id="isHanded">
            </div>

            <h3 class="hide fail start1">Сумма брака</h3>

            @if ($receipt->isPaid)
                <div class="divPayment hide">
                @else
                    <div class="divPayment">
            @endif

            <h3 class="start1 end3">Оплата</h3>
            <div>
                <input type="radio" name="payment" id="nal" value="1">
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



    <input type="submit" class="beautyButton submitButton start5 end7 right rstart7" value="Выдать">
    </form>
    </div>

    <script>
        function showFailSumm() {
            $('.divPayment h3').hide();
            $('#kassa').parent().hide();
            $('#nal').parent().hide();
            $('.divPaymentMethod.divNal').show();
            $('.fail').show();
            $('#payNalNum').parent().hide();




            if ($('.divPayment').hasClass('hide')) {
                $('.divPayment').show();
                $('.divPayment').addClass('hidden');

            }
        }

        function hideFailSumm() {
            $('#payNalNum').parent().show();

            $('.divPayment h3').show();

            $('#kassa').parent().show();
            $('#nal').parent().show();
            $('.divPaymentMethod.divNal').hide();
            $('.fail').hide();

            if ($('.divPayment').hasClass('hidden')) {
                $('.divPayment').hide();
                $('.divPayment').addClass('hide');

            }


        }
        $(document).ready(function() {


            $("#isFail").on('click', function() {
                if ($("#isFail").is(':checked')) {
                    showFailSumm();
                } else {
                    hideFailSumm();
                }
            })



        });
    </script>
@endsection
