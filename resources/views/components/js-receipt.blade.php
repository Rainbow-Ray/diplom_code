<div class="card">
    <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">

        <div class="itemInfo receiptInfo">
            <span class="cardLabel">№:</span>
            <p class="cardData">{{ $item->number }}</p>

            <span class="cardLabel">ФИО:</span>
            <p class="cardData">{{ $item->customer->surname }} {{ $item->customer->name }}
                {{ $item->customer->patronym }}</p>
            <span class="cardLabel">Изделие:</span>
            <p class="cardData">{{ $item->item }}</p>
            <span class="cardLabel">Услуга:</span>
            <p class="cardData">{{ $item->order->service->name }}</p>
            <span class="cardLabel">Дата приема:</span>
            <p class="cardData">{{ $item->dateIn() }}</p>




            @if (!$item->order->isHanded)
                <span class="cardLabel">Пред.дата выдачи:</span>
                <p class="cardData">{{ $item->datePlan() }}</p>

                <span class="cardLabel isDone">Готов к выдаче:</span>
                @if ($item->order->isDone)
                    <p class="cardData done isDone">✓</p>
                @else
                    <p class="cardData notDone isDone">❌</p>
                @endif
            @else
                <span class="cardLabel">Дата выдачи:</span>
                <p class="cardData">{{ $item->dateOut() }}</p>

            @endif


        </div>

        <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">



            <img src="{{ asset('assets/css/angle-right-svgrepo-com.svg') }}" alt="">
        </a>




        <div class="orderDetailLabel closed">
            <span class="buttonDetail"></span>

            <div class="orderDetail">
                <div class="itemInfo info5">
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
