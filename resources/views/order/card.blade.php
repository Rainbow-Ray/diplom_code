@extends('List')
@section('title')
    <title>Заказ</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/filter/filter.js') }}"></script>
@endsection
@section('header')
    Заказы
@endsection


@section('addButton')
@endsection

@section('dictCard')
    <button class="filter allItems" id="all">Все</button>
    <button class="filter mine" id="mine">Заказы к выполнению</button>
    <button class="filter doneItems" id="done">Готовы</button>
    <button class="filter notDoneItems" id="inWork">Выполняются</button>
    <button class="filter receiptClosed" id="closed">Квитанция закрыта</button>

    @foreach ($items as $item)
        <div
            class="card 
@if ($item->isUrgent) urgent @endif @if ($item->isHanded) handed @else  working @endif  @if ($item->isDone) orDone @else noDone @endif ">
            <div>
                <div class="itemInfo info7">
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

            </div>
            <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">



                <img src="{{ asset('assets/css/angle-right-svgrepo-com.svg') }}" alt="">
            </a>


        </div>
    @endforeach

    <script>
        $(document).ready(function() {
            $('#all').on('click', function(e) {
                orders(e.target.id, 'Все');
            });
            $('#mine').on('click', function(e) {
                orders(e.target.id, 'Заказы к выполнению');

            });
            $('#done').on('click', function(e) {
                orders(e.target.id, 'Готовые заказы');

            });
            $('#inWork').on('click', function(e) {
                orders(e.target.id, 'Заказы в процессе выполнения');

            });
            $('#closed').on('click', function(e) {
                orders(e.target.id, 'Выданные заказы');

            });

            $('#mine').trigger('click');
        });
    </script>


    {{-- <script>
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

        function showInProgress() {
            hideCards();
            $(".working.noDone").each(function() {
                $(this).show();
            })
            $('h1').text("Выполняются");
        }


        $(document).ready(function() {
            $('.allItems').on("click", function() {
                $(".card").each(function() {
                    $(this).show();
                })
                $('h1').text("Заказы");

            })
            $('.doneItems').on("click", function() {
                hideCards();
                $(".working.orDone").each(function() {
                    $(this).show();

                })

                $('h1').text("Готовы");
            })
            $('.notDoneItems').on("click", function() {
                showInProgress();
            })


            $('.receiptClosed').on("click", function() {
                hideCards();
                $(".handed").each(function() {
                    $(this).show();
                })
                $('h1').text("Квитанция закрыта");

            })

            showInProgress();
        });
    </script> --}}
@endsection
