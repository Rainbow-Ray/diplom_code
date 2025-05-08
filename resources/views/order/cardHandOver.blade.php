@extends('index')

@section('title')
<title>Выдать заказ</title>

@endsection

@section('scripts')
<script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src=" {{asset('assets/js/payment/paymentScripts.js')}}"></script>
@endsection
@section('main')
<h2>Выдать заказ</h2>

<div class="">
    <div class="">
        <span class="cardLabel">ФИО:</span>
        <span class="cardData">{{$receipt->customer->surname}} {{$receipt->customer->name}} {{$receipt->customer->patronym}}</span>
        <span class="cardLabel">Изделие:</span>
        <span class="cardData">{{$receipt->item}}</span>
        <span class="cardLabel">Услуга:</span>
        <span class="cardData">{{$receipt->order->service->name}}</span>
        <span class="cardLabel">Дата приема:</span>
        <span class="cardData">{{$receipt->dateIn}}</span>
        <span class="cardLabel">Пред.стоимость:</span>
        <span class="cardData">{{$receipt->costPred}}</span>

        @if($receipt->isPaid)
        <span class="cardData done isDone">Оплачено</span>
        @else
        <span class="cardData notDone isDone">Нет оплаты</span>
        @endif

        <hr>
        <span class="cardLabel">Кол-во по квитанции:</span>
        <span class="cardData">{{$receipt->order->count}}</span>

        <span class="cardLabel">Кол-во готово:</span>
        <span class="cardData">{{$receipt->order->countDone}}</span>

        <span class="cardLabel">Кол-во выдано:</span>
        <span class="cardData">{{$receipt->order->handedOverCount()}}</span>
    </div>

    <form action="/{{$rootURL}}/{{$receipt->id}}/hand_over" method="POST" class="receiptForm">
        @csrf
          <div class="divFail">
            <label for="isFail">Брак</label>
            <input type="checkbox" name="isFail" id="isFail">
          </div>
          <div class="divDate">
            <label for="date">Дата</label>
            <input type="date" name="date" id="date" value="{{date('Y-m-d',time())}}">
          </div>
          <div class="divCount">
            <label for="count">Количество</label>
            <input type="number" max="{{$receipt->order->count}}" min="0" value="0" name="count" id="count">
          </div>
          <div class="divNote">
            <label for="note">Примечание</label>
            <input type="text" name="note" id="note">
          </div>
          <div class="divOrderHanded">
            <label for="isHanded">Заказ выдан в полном объеме</label>
            <input type="checkbox" name="isHanded" id="isHanded">
          </div>


          <div class="divPayment">
            <div>
              <input type="radio" name="payment" id="nal" value="1">
              <label for="nal">Наличный расчет</label>
            </div>
            <div >
              <input type="radio" name="payment" id="kassa" value="2"> 
              <label for="kassa">Безналичный расчет</label>
            </div>
            <div class="divPaymentMethod divNal">
              <label for="payNal">Сумма</label>
              <input type="money" name="amount" id="payNal">
              <span> руб.</span>
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



        <input type="submit" value="Выдать">
    </form>
</div>

<script>

</script>

@endsection