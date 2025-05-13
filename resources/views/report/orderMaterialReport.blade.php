@extends('report.report')

@section('title')
    <title>Затраченные материалы  </title>
@endsection

@section('scripts')
@endsection
@section('main')

@section('reportHeader')
<h3>Затраченные материалы за период  </h3>
@endsection

@section('dates')
{{$dateS}} - {{$dateE}}
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
            <td >{{$orderSumm}}</td>
            <td>{{$expenseSumm}}</td>
            <td>{{$orderSumm - $expenseSumm}}</td>
        </tr>
    </tbody>
</table>


<h3>Заказы</h3>
<table>
    <thead>
        <th>Услуга</th>
        <th>Кол-во изделий</th>
        <th>Дата оформления</th>
        <th>Сумма, руб.</th>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->service->name}}</td>
            <td>{{($row->count)}}</td>
            <td>{{$row->beauty_date()}}</td>
            <td>{{$row->receipt->cost}}</td>
        </tr>
        @endforeach
        <tr class="itog">
            <td>ИТОГО:</td>
            <td>{{count($rows)}}</td>
            <td></td>
            <td>{{$orderSumm}}</td>
        </tr>

    </tbody>
</table>





<h3>Заказы</h3>
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
        @foreach($expenseRows as $row)
        <tr>
            <td>{{$row->item()}}</td>
            <td>{{($row->category())}}</td>
            <td>{{$row->count}}</td>
            <td>{{$row->ei->name}}</td>
            <td>{{$row->purchase->date}}</td>
            <td>{{$row->sum}}</td>
        </tr>
        @endforeach
        <tr class="itog">
            <td>ИТОГО:</td>
            <td></td>
            <td>{{$expenseAmountSumm}}</td>
            <td></td>
            <td></td>
            <td>{{$expenseSumm}}</td>
        </tr>
    </tbody>
</table>



@endsection

