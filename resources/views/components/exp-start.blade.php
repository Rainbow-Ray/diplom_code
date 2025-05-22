<div class="card">
    <div>
        <div class="itemInfo orderInfo">
                    <span class="cardLabel">Дата:</span>
                    <span class="cardData">{{ $item->date() }} </span>
                    <span class="cardLabel">Количество материалов:</span>
                    <span class="cardData">{{ $item->rowCount }}</span>
                    <span class="cardLabel">Количество израсходовано:</span>
                    <span class="cardData">{{ $item->dateAmount }}</span>
        </div>
    </div>

    <a href="{{ url('material/exp/edit/'.$item->date, []) }}">
        <img src="{{ asset('assets/css/angle-right-svgrepo-com.svg') }}" alt="">
    </a>

    <div class="orderDetailLabel closed">
        <span class="buttonDetail"></span>
        <div class="orderDetail">
