@extends('index')

@section('title')
    <title>Новый расход материала</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/material/materialExpense.js') }}" type="module"></script>
<script>




</script>
@endsection
@section('main')
    <form action="{{url('material/exp')}}" method="POST">
        @csrf
        <h2 class="end7">Расход материала</h2>

                <div class="labelTop">
            <label for="date">Дата:</label>
            <input type="date" name="date" id="date" value="{{date('Y-m-d', time())}}" required>
        </div>

        <fieldset class="start1 end6">
            <h3 class="noMargin">Фильтры</h3>
        <div class="labelTop">
            <label for="cat">Категория материала:</label>
            <select id="cat" name="cat">
                @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}">
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        </fieldset>

        <div class="labelTop start1 end3">
            <label for="mat">Израсходованный материал:</label>
            <select id="mat" name="mat">
                @foreach ($mats as $mat)
                    <option value="{{ $mat->id }}" ei="{{$mat->ei->name}}" count="{{$mat->amount()}}">
                        {{ $mat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="labelTop start3">
            <span>Кол-во сейчас:</span>
            <span id="countNow"></span>


        </div>

        <div class="labelTop col2 start4 end6">
            <label for="amount">Количество:</label>
            <input type="number" name="amount" id="amount" min='0' value="1" required>
                        <span class="start2">Ед. изм.</span>
            <span id="ei" class="start2"></span>

        </div>
        <input type="button" class="addButton beautyButton" id="addItem" value="Добавить">

        <h4 class="notDone noMargin start1 end7" id="error"></h4>

        <table class="start1 end4">
            <thead>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Ед. измерения</th>
            </thead>

            <tbody id="itemTable">

            </tbody>
        </table>
        <input type="button" id="deleteItem" class="beautyButton" value="-">

        <input class="beautyButton submitButton end7 rstart11" type="submit" value="Отправить">
    </form>
@endsection
