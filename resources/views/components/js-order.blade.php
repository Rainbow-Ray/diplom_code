        <div class="card @if ($item->isUrgent) urgent @endif">
            <div>
                <div class="itemInfo info7">
                    <span class="cardLabel">Услуга:</span>
                    <span class="cardData">{{ $item->service->name }}
                    </span>
                    <span class="cardLabel">Изделие:</span>
                    <span class="cardData">{{ $item->receipt->item }}</span>

                    @if ($item->isHanded)

                        <span class="cardLabel start4 end6">Дата приема:</span>
                        <span class="cardData start4 end6">{{ $item->receipt->dateIn() }}</span>

                        <span class="cardLabel start6 end8">Дата выдачи:</span>
                        <span class="cardData start6 end8">{{ $item->receipt->dateOut() }}</span>
                    @else
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
                        <span class="cardData">{{ $item->receipt->dateIn() }}</span>



                        <span class="cardLabel">Пред. дата выдачи:</span>
                        <span class="cardData">{{ $item->receipt->datePlan() }}</span>

                    @endif
                </div>
            </div>
            <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">
                <img src="{{ asset('assets/css/angle-right-svgrepo-com.svg') }}" alt="">
            </a>
        </div>
