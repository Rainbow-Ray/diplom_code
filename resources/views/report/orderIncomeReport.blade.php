@extends('report.report')

@section('title')
    <title>Доход за заказы </title>
@endsection

@section('scripts')
@endsection
@section('main')

@section('reportHeader')
<h3>Доход за заказы </h3>
@endsection

@section('dates')
{{$dateS}} - {{$dateE}}
@endsection

<h3>Доход за заказы</h3>
<table>
    <thead>
        <th>Доход за заказы, руб.</th>
        <th>Ср. стоимость, руб.</th>
    </thead>
    <tbody>
        <tr>
            <td >{{$summ}}</td>
            <td>{{$avg}}</td>
        </tr>
    </tbody>
</table>


<h3>Заказы</h3>
<table>
    <thead>
        <th>Услуга</th>
        <th>Кол-во изделий</th>
        <th>Заказчик</th>
        <th>Дата оформления</th>
        <th>Сумма, руб.</th>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->service->name}}</td>
            <td>{{($row->count)}}</td>
            <td class="italic">
                {{$row->receipt->customer->surname}} {{Str::substr($row->receipt->customer->name, 0, 1)}}.{{Str::substr($row->receipt->customer->patronym, 0, 1)}}.

            </td>
            <td>{{$row->beauty_date()}}</td>
            <td>{{$row->receipt->cost}}</td>
        </tr>
        @endforeach
        <tr class="itog">
            <td>ИТОГО:</td>
            <td>{{count($rows)}}</td>
            <td></td>
            <td></td>
            <td>{{$summ}}</td>
        </tr>

    </tbody>
</table>

@endsection

