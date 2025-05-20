
<table  {{ $attributes }}>
    <tr>
        <th>
            Дата
        </th>
        <th>
            Номер чека
        </th>
                <th class="tdRight">
            Сумма, руб.
        </th>

    </tr>

    @foreach ($income as $inc)
    <tr>
        <td>{{$inc->date()}}</td>
                <td>{{$inc->number}}</td>

        <td class="tdRight">{{$inc->amount}}</td>
        {{-- <td>
            <a href="{{ url('/'.strval($out->id).'/edit', []) }}">
                <button>Редактировать</button>
                </a>
    
        </td> --}}
    </tr>
    @endforeach     
</table>
