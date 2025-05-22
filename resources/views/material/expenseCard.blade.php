@extends('List')
@section('title')
    <title>Расход материалов</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/filter/filter.js') }}"></script>
@endsection
@section('header')
    Расход материалов
@endsection


@section('addButton')
    <a class="right" href="{{ url('material/exp', []) }}">
        <button class="addButton beautyButton">Расход материала</button>
    </a>
@endsection

@section('dictCard')
    <input type="date" class="filter" id="dateStart"
        value="{{ (new DateTime('yesterday', new DateTimeZone('Asia/Yekaterinburg')))->format('Y-m-d') }}">
    <input type="date" class="filter" id="dateEnd"
        value="{{ (new DateTime('now', new DateTimeZone('Asia/Yekaterinburg')))->format('Y-m-d') }}">

    <button class="filter mine" id="date">Показать за даты</button>
    <button class="filter allItems" id="all">Все</button>


    <x-material-expense :items="$items" />


    <script>
        $(document).ready(function() {
            $('#all').on('click', function(e) {
                dateS = $('#dateStart').val();
                dateE = $('#dateEnd').val();
                matExp(e.target.id, dateS, dateE, 'Все');
            });
            $('#date').on('click', function(e) {
                dateS = $('#dateStart').val();
                dateE = $('#dateEnd').val();
                matExp(e.target.id, dateS, dateE, 'Доходы от ' + dateS + " до " + dateE);
            });

            // $('#mine').trigger('click');
        });
    </script>
@endsection
