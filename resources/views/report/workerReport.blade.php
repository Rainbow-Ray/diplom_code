@extends('report.report')

@section('title')
    <title>Количество выполненных заказов на мастера </title>
@endsection

@section('scripts')
@endsection
@section('main')

@section('reportHeader')
<h3>Количество выполненных заказов на мастера за период</h3>
@endsection

@section('dates')
{{$dateS}} - {{$dateE}}
@endsection

<h3>Количество заказов у мастеров</h3>

{{-- {{print_r($rows)}}
{{print_r($fails)}} --}}

<table>
    <thead>
        <th>Мастер </th>
        <th>Кол-во заказов, шт.</th>
        <th>Заказов  за день, шт.</th>
        <th>Брак, шт.</th>
        <th>Процент брака, %</th>
        <th>Стоимость заказов, руб.</th>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->surname}} 
                {{$row->name}}
                {{$row->patronym}} 
            </td>
            <td>{{$row->orderCount}}</td>
            <td>{{number_format($row->orderDay,  2, ',', '')}}</td>
            <td>{{$row->fails}}</td>
            <td>{{number_format(($row->fails)/($row->orderCount)*100,  2, ',', '')}}</td>
            <td>{{$row->sum}}</td>
        </tr>

        @endforeach
        <tr class="itog">
            <td> ИТОГО:
            </td>
            <td>{{$itog}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$sum}}</td>
        </tr>

    </tbody>
</table>


<p>Средний процент брака: {{number_format($avgFail, 2, ',', '')}}%</p>
<p>Среднее количество выполненных за день заказов: {{number_format($avgOrder, 2, ',', '')}}%</p>

@endsection

