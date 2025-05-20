@extends('report.report')

@section('title')
    <title>Доходы и расходы предприятия за период</title>
@endsection

@section('scripts')
@endsection
@section('main')

@section('reportHeader')
<h3>Доходы и расходы предприятия</h3>
@endsection

@section('dates')
{{$dateS}} - {{$dateE}}
@endsection


<table>
    <thead>
        <th colspan=2>Доходы</th>
        <th colspan=2>Расходы</th>
        <th>Выручка, руб.</th>
    </thead>
    <thead >
        <th>Источник</th>
        <th>Сумма, руб.</th>
        <th>Источник</th>
        <th>Сумма, руб.</th>
        <th></th>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td class="italic">{{$row->get('iname')}}</td>
            <td>{{($row->get('isum'))}}</td>

            <td class="italic">{{$row->get('ename')}}</td>
            <td>{{$row->get('esum')}}</td>
            <td></td>

        </tr>

        @endforeach
        <tr class="itog">
            <td>ИТОГО:</td>
            <td>{{$iItog}}</td>
            <td></td>
            <td>{{$eItog}}</td>
            <td>{{$profit}}</td>
        </tr>

    </tbody>
</table>

@endsection

