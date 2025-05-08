
<table  {{ $attributes }}>
    <tr>
        <th>
            ID
        </th>
        <th>
            Дата
        </th>
        <th>
            Кол-во
        </th>
        <th>
            Заметка
        </th>
        <th>
            Брак
        </th>
    </tr>

    @foreach ($order->orderOut as $out)
    <tr>
        <td>{{$out->id}}</td>
        <td>{{$out->date}}</td>
        <td>{{$out->count}}</td>
        <td>{{$out->note}}</td>
        <td>
            @if($out->isFail)
            <span class="cardData notDone isDone">Брак</span>
            @endif
        
        </td>
        {{-- <td>
            <a href="{{ url('/'.strval($out->id).'/edit', []) }}">
                <button>Редактировать</button>
                </a>
    
        </td> --}}
    </tr>
    @endforeach 


    
</table>

<div class="orderCount col1-2">

    <span class="cardData done">Выдано:</span>
    <span class="cardData done">{{$order->handedOverCount()}}</span>
    <span class="cardData notDone">К выдаче:</span>
    <span class="cardData notDone">{{($order->count) - ($order->handedOverCount())}}</span>
</div>




