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
