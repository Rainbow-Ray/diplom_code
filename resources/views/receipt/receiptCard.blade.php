@extends('List')
@section('title')
    <title>Квитанции</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
    Квитанции
@endsection


@section('addButton')
    <a class="addButtonLink" href="{{ url($rootURL . '/create', []) }}">
        <button class="addButton">
            Добавить квитанцию
        </button>
    </a>
@endsection


@section('dictCard')
    <button class="filter allItems">Все</button>
    <button class="filter doneItems">Готовы к выдаче</button>
    <button class="filter handedItems">Выданы</button>


    @foreach ($items as $item)
        @if ($item->order->isHanded)
            <div class="card handed">
            @else
                <div class="card">
        @endif
        <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">

            <div class="itemInfo receiptInfo">
                <span class="cardLabel">ФИО:</span>
                <p class="cardData">{{ $item->customer->surname }} {{ $item->customer->name }}
                    {{ $item->customer->patronym }}</p>
                <span class="cardLabel">Изделие:</span>
                <p class="cardData">{{ $item->item }}</p>
                <span class="cardLabel">Услуга:</span>
                <p class="cardData">{{ $item->order->service->name }}</p>
                <span class="cardLabel">Дата приема:</span>
                <p class="cardData">{{ $item->dateIn }}</p>
                <span class="cardLabel">Пред.дата выдачи:</span>
                <p class="cardData">{{ $item->datePlan }}</p>

                <span class="cardLabel isDone">Готов к выдаче:</span>
                @if ($item->order->isDone)
                    <p class="cardData done isDone">✓</p>
                @else
                    <p class="cardData notDone isDone">❌</p>
                @endif

            </div>
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                    <button>Редактировать</button>
                </a>


                <a href="{{ url($rootURL . '/' . strval($item->id) . '/hand_over', []) }}">
                    <button>Выдать</button>
                </a>

            </div>

            <div class="orderDetailLabel">
                <span class="buttonDetail"></span>

                <div class="orderDetail">
                    <div class="itemInfo orderInfo">
                        <span class="cardLabel">Услуга:</span>
                        <span class="cardData">{{ $item->order->service->name }}</span>
                        <span class="cardLabel">Кол-во всего:</span>
                        <span class="cardData">{{ $item->order->count }}</span>
                        <span class="cardLabel">Кол-во готово:</span>
                        <span class="cardData">{{ $item->order->countDone }}</span>
                        <span class="cardLabel">Кол-во выдано:</span>
                        <span class="cardData">{{ $item->order->handedOverCount() }}</span>
                        <span class="cardLabel isDone">Готов:</span>
                        @if ($item->order->isDone)
                            <span class="cardData done isDone">✓</span>
                        @else
                            <span class="cardData notDone isDone">❌</span>
                        @endif

                    </div>

                </div>
            </div>

        </a>
        </div>
    @endforeach

    <script>
        function showCards() {
            $('.card').each(function() {
                $(this).show();
            })
        }

        function hideCards() {
            $('.card').each(function() {
                $(this).hide();
            })
        }

        function hideHanded() {
            $('.handed').hide();
        }


        $(document).ready(function() {
            hideHanded();
            $('.handedItems').on("click", function() {
                hideCards();
                $(".handed").each(function() {
                    $(this).show();
                    $('h1').text("Выдано");

                })
            })



            $('.allItems').on("click", function() {

                $(".card").each(function() {
                    $(this).show();
                    $('h1').text("Квитанции");
                })
                hideHanded();
            })
            $('.doneItems').on("click", function() {
                $(".notDone").parents('.card').each(function() {
                    $(this).hide();
                    $('h1').text("Готовы к выдаче");
                })
            })
        });
    </script>
@endsection
