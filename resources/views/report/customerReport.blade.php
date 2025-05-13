@extends('report.report')

@section('title')
    <title>Постоянные клиенты  </title>
@endsection

@section('scripts')
@endsection
@section('main')

@section('reportHeader')
<h3>Постоянные клиенты </h3>
@endsection

@section('dates')
{{$dateS}} - {{$dateE}}
@endsection

<h3>Клиенты и их покупки</h3>

{{-- {{print_r($rows)}}
{{print_r($fails)}} --}}

<table>
    <thead>
        <th>Клиент </th>
        <th>Кол-во заказов</th>
        <th>Средняя сумма чека</th>
        <th>Персональная скидка</th>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>
                {{$row->surname}} 
                {{$row->name}}
                {{$row->patronym}} 
            </td>
            <td>{{$row->countOrder}} </td>
            <td>{{$row->avg}}</td>
            <td>{{$row->discount}}%</td>
            </tr>

        @endforeach
        <tr class="itog">
            <td> ИТОГО:
            </td>
            <td>{{$itog}}</td>
            <td></td>
            <td></td>
        </tr>

    </tbody>
</table>


<p>Средняя сумма чека: {{$avgSum}} руб.</p>
<p>Средний коэффициент повторных покупок: {{$rpr}}</p>

@endsection

