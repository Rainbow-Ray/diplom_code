@extends('List')
@section('title')
    <title>Расходы</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/filter/filter.js') }}"></script>
@endsection

@section('header')
    Расходы
@endsection


@section('addButton')
    <a class="addButtonLink" href="{{ url($rootURL . '/create', []) }}">
        <button class="addButton beautyButton">
            Добавить расход
        </button>
    </a>
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

                @if ($item->amount > 0)
                    <span class="cardData">{{ $item->amount }} руб.</span>
                @else
                    <span class="cardData">0 руб.</span>
                @endif

                <span class="cardLabel start4 end6">Целевой сотрудник:</span>
                <span class="cardData start4 end6">{{ $item->worker->surname }} {{ $item->worker->name }}
                    {{ $item->worker->patronym }}</span>

                @if (!is_null($item->orderOut_id))
                    <span class="cardLabel">№ квитанции:</span>
                    <span class="cardData">{{ $item->receipt()->number }}</span>
                @endif

            </div>
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">
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
                expense(e.target.id, dateS, dateE, 'Все');
            });
            $('#date').on('click', function(e) {
                dateS = $('#dateStart').val();
                dateE = $('#dateEnd').val();
                expense(e.target.id, dateS, dateE, 'Расходы от ' + dateS + " до " + dateE);
            });

            // $('#mine').trigger('click');
        });
    </script>
@endsection
