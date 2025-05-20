@section('title')
    <title>Заказ {{$item->service->name }}</title>

@endsection

@section('header')
    Заказ №{{$item->id}} {{$item->service->name}}
@endsection

@section('cardData')
    <x-order-card :order="$item"/>
                <a href="{{ url('order/' . strval($item->id) . '/edit', []) }}">
                <button class="addButton beautyButton">Добавить изделия</button>
            </a>

                <a class="right" target='_blank' href="{{ url('material/exp', []) }}">
                <button class="addButton beautyButton">Расход материала</button>
            </a>

@endsection

@section('cardDetails')
<h3>Выдачи по заказу</h3>
<x-order-out :order="$item"/>

{{-- <table>
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

    @foreach ($item->orderOut as $out)
    <tr>
        <td>{{$out->id}}</td>
        <td>{{$out->date}}</td>
        <td>{{$out->count}}</td>
        <td>{{$out->note}}</td>
        <td>
            @if($out->isFail)
            <span class="cardData notDone isDone">Брак</span>
        
            @endif
        
        </td> --}}
        {{-- <td>
            <a href="{{ url('/'.strval($out->id).'/edit', []) }}">
                <button>Редактировать</button>
                </a>
    
        </td> --}}
    </tr>
    {{-- @endforeach 
</table>--}}
@endsection 
