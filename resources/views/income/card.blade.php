@extends('List')
@section('title')
    <title>Доходы</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/filter/filter.js') }}"></script>
@endsection

@section('header')
    Доходы
@endsection


@section('addButton')
    {{-- <a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Добавить доход
    </button>
</a> --}}
@endsection


@section('dictCard')
    <input type="date" class="filter" id="dateStart"
        value="{{ (new DateTime('yesterday', new DateTimeZone('Asia/Yekaterinburg')))->format('Y-m-d') }}">
    <input type="date" class="filter" id="dateEnd"
        value="{{ (new DateTime('now', new DateTimeZone('Asia/Yekaterinburg')))->format('Y-m-d') }}">

    <button class="filter mine" id="date">Показать за даты</button>
    <button class="filter allItems" id="all">Все</button>


    @foreach ($items as $item)
        <div class="card">
            <div class="itemInfo info5">
                <span class="cardLabel">Источник:</span>
                <span class="cardData">{{ $item->source->name }}</span>

                <span class="cardLabel">Дата:</span>
                <span class="cardData">{{ $item->date }}</span>

                <span class="cardLabel">Сумма:</span>
                <span class="cardData">{{ $item->amount }} руб.</span>

                <span class="cardLabel">Номер:</span>
                <span class="cardData">{{ $item->number }}</span>


            </div>
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                    <img src="{{ asset('assets/css/angle-right-svgrepo-com.svg') }}" alt="">
                </a>

            </div>
        </div>
    @endforeach

    <script>
        $(document).ready(function() {
            $('#all').on('click', function(e) {
                dateS = $('#dateStart').val();
                dateE = $('#dateEnd').val();
                incomes(e.target.id, dateS, dateE, 'Все');
            });
            $('#date').on('click', function(e) {
                dateS = $('#dateStart').val();
                dateE = $('#dateEnd').val();
                incomes(e.target.id, dateS, dateE, 'Доходы от ' + dateS + " до " + dateE);
            });

            // $('#mine').trigger('click');
        });
    </script>
@endsection
