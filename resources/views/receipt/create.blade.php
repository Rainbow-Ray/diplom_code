@extends('index')

@section('title')
    <title>Добавить квитанцию</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/payment/paymentScripts.js') }}" type="module"></script>
    <script src=" {{ asset('assets/js/receipt/countSum.js') }}"></script>
@endsection
@section('main')
    <form action="/{{ $rootURL }}" method="POST" class="col5">
        @csrf
        <h2>Добавить квитанцию</h2>

        <div class="labelTop start1">
            <label for="number">Номер квитанции:</label>
            <input type="text" name="number" id="number" value="{{ $number }}" required>
        </div>

        <div class="labelTop start1 end3">
            <label for="customer">ФИО/Тел.</label>
            <select id="selectCustomer" name="customer">
                <option value=""></option>
                @foreach ($customers as $customer)
                    @if ($customer->id == old('customer'))
                        <option value="{{ $customer->id }}" discount="{{ $customer->discount }}" selected>
                        @else
                        <option value="{{ $customer->id }}" discount="{{ $customer->discount }}">
                    @endif
                    {{ $customer->surname . ' ' . $customer->name . ' ' . $customer->patronym . ' // ' . $customer->phone }}
                    </option>
                @endforeach
            </select>
            <input type="text" id="discount" class="hide" value="0" readonly>

        </div>

        <div class="labelTop">
            <div>
                <span>Скидка: </span>
                <span id='disc'></span>
                <span>%</span>
            </div>
            <div>
                <label for="">Применить скидку</label>
                <input type="checkbox" id="applyDiscount" checked>
            </div>
        </div>

        <div class="labelTop start4">
            <label for="dateIn">Дата приема:</label>
            <input type="date" name="dateIn" id="dateIn" value="{{ date('Y-m-d', time()) }}" required>

        </div>
        <div class="labelTop">
            <label for="datePlan">Пред. дата получения:</label>
            <input type="date" name="datePlan" id="datePlan">

        </div>


        <div class="labelTop start1 end3">
            <label for="item">Наименование изделия:</label>
            <input type="text" name="item" id="item" value="{{ old('item') }}" required>
        </div>
        <div class="labelTop">
            <label for="count">Количество:</label>
            <input type="number" name="count" id="count" min="1" value="{{ old('count', 1) }}" required>
        </div>

        <div class="labelTop start5 ">
            <label for="dateOut">Факт. дата выдачи:</label>
            <input type="date" name="dateOut" id="dateOut" value="{{ old('dateOut') }}">
        </div>

        <div class="labelTop start1 end4">
            <label for="service">Вид ремонта(услуги):</label>

            <select id="service" name="service">
                <option value=""></option>
                @foreach ($services as $service)
                    @if ($service->id == old('service'))
                        <option value="{{ $service->id }}" cost="{{$service->cost}}" selected>
                        @else
                        <option value="{{ $service->id }}" cost="{{$service->cost}}">
                    @endif
                    {{ $service->name . ' // ' . $service->cost }} руб.
                    </option>
                @endforeach
            </select>
        </div>

        <div class="labelTop price start4">
            <label for="costPred">Пред. стоимость:</label>
            <input type="money" name="costPred" id="costPred" value="{{ old('costPred') }}">
            <span>руб.</span>
        </div>

        <div class="labelTop price">
            <label for="costAdd">Доплата:</label>
            <input type="money" name="costAdd" id="costAdd" value="{{ old('costAdd') }}">
            <span>руб.</span>
        </div>
        <div class="labelTop start1 end3">
            <label for="selectWorker">Мастер:</label>
            <select id="selectWorker" name="worker">
                <option value=""></option>
                @foreach ($workers as $worker)
                    @if ($worker->id == old('worker'))
                        <option value="{{ $worker->id }}" selected>
                        @else
                        <option value="{{ $worker->id }}">
                    @endif
                    {{ $worker->surname . ' ' . $worker->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="divisUrgent center right">
            <label for="isUrgent">Срочный заказ</label>
            <input type="checkbox" name="isUrgent" id="isUrgent" @if(old('isUrgent')) checked @endif>

        </div>
        <div class="divisPaid center right">
            <label for="isPaid">Оплачено</label>
            <input type="checkbox" name="isPaid" id="isPaid" @if(old('isPaid')) checked @endif>

        </div>



        <div class="labelTop price start5">
            <label for="cost">Конечная стоимость:</label>
            <input type="money" name="cost" id="cost" value="{{ old('cost') }}">
            <span>руб.</span>
        </div>




        <div class="labelTop start1">
            <label for="note">Примечание</label>
            <input type="text" name="note" id="note" value="{{ old('note') }}">
        </div>

        <div class="divPayment">
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


        <input type="submit" class="submitButton start5 right beautyButton rstart9" value="Отправить">
    </form>


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
