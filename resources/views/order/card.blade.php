@extends('List')
@section('title')
    <title>Заказ</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection
@section('header')
    Заказы
@endsection


@section('addButton')
@endsection

@section('dictCard')
    <button class="filter allItems">Все</button>
    <button class="filter doneItems">Готовы</button>
    <button class="filter notDoneItems">Выполняются</button>
    <button class="filter receiptClosed">Квитанция закрыта</button>



    @foreach ($items as $item)
        <div class="card 
@if ($item->isUrgent) urgent @else @if ($item->isHanded) handed @endif @endif ">
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">
                    <div class="itemInfo orderInfo">
                        <span class="cardLabel">Услуга:</span>
                        <span class="cardData">{{ $item->service->name }}
                        </span>
                        <span class="cardLabel">Изделие:</span>
                        <span class="cardData">{{ $item->receipt->item }}</span>
                        <span class="cardLabel">Кол-во всего:</span>
                        <span class="cardData">{{ $item->count }}</span>
                        <span class="cardLabel">Кол-во готово:</span>
                        <span class="cardData">{{ $item->countDone }}</span>
                        <span class="cardLabel isDone">Готов:</span>
                        @if ($item->isDone)
                            <span class="cardData done isDone">✓</span>
                        @else
                            <span class="cardData notDone isDone">❌</span>
                        @endif
                        <span class="cardLabel">Дата приема:</span>
                        <span class="cardData">{{ $item->receipt->dateIn }}</span>
                        <span class="cardLabel">Пред. дата выдачи:</span>
                        <span class="cardData">{{ $item->receipt->datePlan }}</span>
                    </div>
                </a>

            </div>



            <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                <button>Добавить изделия</button>
            </a>

        </div>
    @endforeach


    <script>
        function showCards() {
            $('.card').each(function() {
                $(this).show();
            })

        }
        $(document).ready(function() {
            $('.allItems').on("click", function() {
                $(".card").each(function() {
                    $(this).show();
                    $('h1').text("Заказы");

                })
            })
            $('.doneItems').on("click", function() {
                showCards();
                $(".notDone").parents('.card').each(function() {
                    $(this).hide();
                    $('h1').text("Готовы");
                })
            })
            $('.notDoneItems').on("click", function() {
                showCards();
                $(".done").parents('.card').each(function() {
                    $(this).hide();
                    $('h1').text("Выполняются");
                })
            })

            $('.receiptClosed').on("click", function() {
                showCards();
                $(".handed").each(function() {
                    $(this).hide();
                    $('h1').text("Квитанция закрыта");
                })
            })
        });
    </script>
@endsection
