@extends('report.report')

@section('title')
    <title>Затраченные материалы </title>
@endsection

@section('scripts')
@endsection
@section('main')
@section('reportHeader')
    <h3>Затраченные материалы за период </h3>
@endsection

@section('dates')
    {{ $dateS }} - {{ $dateE }}
@endsection

<h3>Доходы и расходы </h3>
<table>
    <thead>
        <th>Доход за заказы, руб.</th>
        <th>Расходы за закупки, руб.</th>
        <th>Прибыль, руб.</th>
    </thead>
    <tbody>
        <tr>
            <td>{{ $orderSumm }}</td>
            <td>{{ $expenseSumm }}</td>
            <td>{{ $orderSumm - $expenseSumm }}</td>
        </tr>
    </tbody>
</table>


<h3>Оплаченные заказы</h3>
<table>
    <thead>
        <th>Услуга</th>
        <th>Кол-во изделий, шт.</th>
        <th>Дата оформления</th>
        <th>Сумма, руб.</th>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr>
                <td>{{ $row->service->name }}</td>
                <td>{{ $row->count }}</td>
                <td>{{ $row->beauty_date() }}</td>
                <td>{{ $row->receipt->cost }}</td>
            </tr>
        @endforeach
        <tr class="itog">
            <td>ИТОГО:</td>
            <td>{{ $countItog }}</td>
            <td></td>
            <td>{{ $orderSumm }}</td>
        </tr>

    </tbody>
</table>





<h3>Закупки материалов</h3>
<table>
    <thead>
        <th>Наименование материала</th>
        <th>Категория материала</th>
        <th>Кол-во</th>
        <th>Ед. измерения.</th>
        <th>Дата закупки</th>
        <th>Сумма, руб.</th>
    </thead>
    <tbody>
        @foreach ($expenseRows as $row)
            <tr>
                <td>{{ $row->item() }}</td>
                <td>{{ $row->category() }}</td>
                <td>{{ $row->count }}</td>
                <td>{{ $row->material()->ei->name }}</td>
                <td>{{ $row->purchase->date() }}</td>
                <td>{{ $row->sum }}</td>
            </tr>
        @endforeach
        <tr class="itog">
            <td>ИТОГО:</td>
            <td></td>
            <td>{{ $expenseAmountSumm }}</td>
            <td></td>
            <td></td>
            <td>{{ $expenseSumm }}</td>
        </tr>
    </tbody>
</table>



<h3>Сводка по материалам</h3>
<table>
    <thead>
        <th>Наименование материала</th>
        <th>Кол-во на начало периода</th>
        <th>Кол-во закупленного</th>
        <th>Кол-во расход</th>
        <th>Кол-во на конец</th>
        <th>Ед.измерения</th>
    </thead>
    <tbody>

        @for ($i = 0; $i < count($materials); $i++)
            <tr>
                    <td>{{ $materials[$i]->name }}</td>

                @if (is_null($materials[$i]->start_amount))
                    <td>0</td>
                    @else
                    <td>{{ $materials[$i]->start_amount }}</td>
                @endif
                @if (is_null($materials[$i]->income))
                    <td>0</td>
                    @else
                    <td>{{ $materials[$i]->income }}</td>
                @endif
                @if (is_null($materials[$i]->expense))
                    <td>0</td>
                    @else
                    <td>{{$materials[$i]->expense }}</td>
                @endif
                <td class="itog">{{ $matItog[$i] }}</td>
                <td>{{ $materials[$i]->ei }}</td>
            </tr>
        @endfor

        {{-- @foreach ($materials as $row)
        <tr>
            <td>{{$row->name}}</td>
            <td>{{($row->start_amount)}}</td>
            <td>{{$row->income}}</td>
            <td>{{$row->expense}}</td>
            <td>{{$row->itog}}</td>
        </tr>
        @endforeach --}}
    </tbody>
</table>
@endsection
