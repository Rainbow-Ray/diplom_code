<div class="orderInfo" >
    <div class="orderData">
        <span class="cardLabel">Изделие:</span>
        <span class="cardData">{{$order->receipt->item}}</span>
    </div>

    <div class="orderData">
        <span class="cardLabel">Заказчик:</span>
        <span class="cardData">{{$order->receipt->customer->surname." ".$order->receipt->customer->name}}</span>
    </div>

    <div class="dates">
        <span class="cardLabel">От</span>
        <span class="cardData">{{$order->receipt->dateIn()}}</span>
        <span class="cardLabel">к</span>
        <span class="cardData">{{$order->receipt->datePlan()}}</span>
    </div>
    <div class="dates">
        @if ($order->isUrgent)
                    <span class="cardData notDone">Срочный</span>

        @endif
    </div>
    <div class="orderCount col1-3">
        <span class="cardData">По квитанции:</span>
        <span class="cardData">{{$order->count}}</span>
        <span class="cardData done">Готово:</span>
        <span class="cardData done">{{$order->countDone}}</span>
        <span class="cardData notDone">Необходимо:</span>
        <span class="cardData notDone">{{($order->count) - ($order->countDone)}}</span>
    </div>
</div>
