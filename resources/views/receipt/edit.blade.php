@extends('index')

@section('title')
    <title>Редактировать квитанцию</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            //change selectboxes to selectize mode to be searchable
            $("#selectCustomer").select2();
            $("#selectWorker").select2();


            $("#service").select2();

            $("#service").on("change", function() {
                    var str = "";
                    $("#service option:selected").each(function() {
                        str += $(this).text().split('//')[1];
                        str = str.trim();
                        if (str == 'undefined') {
                            str = '';
                        }
                    });
                    $('#costPred').val(str);
                })
                .trigger("change");

        });
    </script>
@endsection
@section('main')
<div class="mainHeader"><h1>Редактировать квитанцию</h1>
</div>
        
    <form action="/{{ $rootURL }}/{{ $receipt->id }}" method="POST" class="receiptForm">
        @csrf
        @method('PUT')


        <div class="labelTop start1 end3">
            <label for="customer">ФИО/Тел.</label>
            <select id="selectCustomer" name="customer">
                <option value=""></option>
                @foreach ($customers as $customer)
                    @if ($customer->id == $receipt->customer_id)
                        <option value="{{ $customer->id }}" selected>
                            {{ $customer->surname . ' ' . $customer->name . ' ' . $customer->patronym . ' // ' . $customer->phone }}
                        </option>
                    @else
                        <option value="{{ $customer->id }}">
                            {{ $customer->surname . ' ' . $customer->name . ' ' . $customer->patronym . ' // ' . $customer->phone }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="labelTop start1 end2">
            <label for="item">Наименование изделия:</label>
            <input type="text" name="item" id="item" value="{{ $receipt->item }}" required>

        </div>

        <div class="labelTop start2 ">
            <label for="count">Количество:</label>
            <input type="number" name="count" id="count" min="1" value="{{ $receipt->order->count }}"
                required>

        </div>


        <div class="labelTop start1 end3">
            <label for="service">Вид ремонта:</label>
            <select id="service" name="service">
                <option value=""></option>
                @foreach ($services as $service)
                    @if ($service->id == $receipt->order->service->id)
                        <option value="{{ $service->id }}" selected>
                            {{ $service->name . ' // ' . $service->cost }}
                        </option>
                    @else
                        <option value="{{ $service->id }}">
                            {{ $service->name . ' // ' . $service->cost }}
                        </option>
                    @endif
                @endforeach
            </select>

        </div>
        <div class="labelTop start1">
            <label for="costPred">Пред. стоимость:</label>
            <div>
                <input type="money" name="costPred" id="costPred" value="{{ $receipt->costPred }}">
                <span>руб.</span>
            </div>
        </div>
        <div class="labelTop start2">
            <label for="costAdd">Доплата:</label>
            <div>
                <input type="money" name="costAdd" id="costAdd" value="{{ $receipt->costAdd }}">
                <span>руб.</span>
            </div>

        </div>
        <div class="labelTop">
            <label for="dateIn">Дата приема:</label>
            <input type="date" name="dateIn" id="dateIn" value="{{ $receipt->dateIn }}" required>

        </div>
        <div class="labelTop">
            <label for="cost">Стоимость ремонта:</label>
            <div>
                <input type="money" name="cost" id="cost" value="{{ $receipt->cost }}">
                <span>руб.</span>
            </div>


        </div>
        <div class="labelTop start1">
            <label for="datePlan">Пред. дата получения:</label>
            <input type="date" name="datePlan" id="datePlan" value="{{ $receipt->datePlan }}">

        </div>
        <div class="labelTop">
            <label for="dateOut">Дата получения:</label>
            <input type="date" name="dateOut" id="dateOut" value="{{ $receipt->dateOut }}">

        </div>
        <div class="labelTop start1 end3">
            <label for="selectWorker">Приемщик:</label>
            <select id="selectWorker" name="worker">
                <option value=""></option>

                @foreach ($workers as $worker)
                    @if ($worker->id == $receipt->worker_id)
                        <option value="{{ $worker->id }}" selected>
                            {{ $worker->surname . ' ' . $worker->name . ' // ' . $worker->job->name }}</option>
                    @else
                        <option value="{{ $worker->id }}">
                            {{ $worker->surname . ' ' . $worker->name . ' // ' . $worker->job->name }}</option>
                    @endif
                @endforeach
            </select>

        </div>
        <div class="labelTop">
            <label for="note">Примечание</label>
            <input type="text" name="note" id="note" value="{{ $receipt->note }}">

        </div>
        <div class="divisUrgent">
            <label for="isUrgent">Срочный заказ</label>
            @if ($receipt->isUrgent == 1)
                <input type="checkbox" name="isUrgent" id="isUrgent" checked ">
@else
    <input type="checkbox" name="isUrgent" id="isUrgent" ">
            @endif

        </div>
        <div class="divisPaid">
            <label for="isPaid">Оплачено</label>
            @if ($receipt->isPaid == 1)
                <input type="checkbox" name="isPaid" id="isPaid" checked ">
@else
    <input type="checkbox" name="isPaid" id="isPaid"">
            @endif
        </div>
        <div>
            <label for="isHanded">Выдан:</label>
            @if ($receipt->order->isHanded == 1)
                <input type="checkbox" name="isHanded" id="isHanded" checked ">
@else
    <input type="checkbox" name="isHanded" id="isHanded"">
            @endif

        </div>

        <input type="submit" class="addButton beautyButton start3 right" value="Отправить">
    </form>


    <form action="/{{ $rootURL }}/{{ $receipt->id }}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="addButton beautyButton danger start1" value="Удалить">
    </form>
    @if ($errors->any())
        <h4>{{ $errors->first() }}</h4>
    @endif
@endsection
