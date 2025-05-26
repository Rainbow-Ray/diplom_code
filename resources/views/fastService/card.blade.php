@extends('List')
@section('title')
    <title>Быстрая услуга</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/filter/filter.js') }}"></script>
@endsection

@section('header')
    Быстрые услуги
@endsection


@section('addButton')
    <a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Новая быстрая услуга
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
                <span class="cardLabel">Номер:</span>
                <span class="cardData">{{ $item->number }}</span>

                <span class="cardLabel">Дата:</span>
                <span class="cardData">{{ $item->date() }}</span>

                <span class="cardLabel start4 end6">Услуга:</span>
                <span class="cardData start4 end6">{{ $item->service->name }}</span>

                <span class="cardLabel">Сумма:</span>
                <span class="cardData">{{ $item->income->amount }} руб.</span>



            </div>
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                    <img src="{{ asset('assets/css/angle-right-svgrepo-com.svg') }}" alt="">
                </a>

            </div>
        </div>
    @endforeach

    <script>

        function beauty_date(date){
            var sep = '.';
            var d = date.slice(-2);
            var m = date.slice(5,7);
            var y = date.slice(0,4);
            return d + sep + m + sep +y;
        }

        $(document).ready(function() {
            $('#all').on('click', function(e) {
                dateS = $('#dateStart').val();
                dateE = $('#dateEnd').val();
                incomes(e.target.id, dateS, dateE, 'Все');
            });
            $('#date').on('click', function(e) {
                dateS = $('#dateStart').val();
                dateE = $('#dateEnd').val();
                incomes(e.target.id, dateS, dateE, 'Доходы от ' +beauty_date(dateS) + '.' + " до " + beauty_date(dateE));
            });

            // $('#mine').trigger('click');
        });
    </script>
@endsection
