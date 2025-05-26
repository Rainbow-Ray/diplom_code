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
    {{ $dateS }} - {{ $dateE }}
@endsection



<h3>Заказы</h3>
<table>
    <thead>
        <th>Услуга</th>
        <th>Кол-во изделий, шт.</th>
        <th>Заказчик</th>
        <th>Дата оформления</th>
        <th>Сумма, руб.</th>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr>
                <td>{{ $row->service->name }}</td>
                <td>{{ $row->count }}</td>
                <td class="italic">
                    {{ $row->receipt->customer->surname }}
                    {{ Str::substr($row->receipt->customer->name, 0, 1) }}.{{ Str::substr($row->receipt->customer->patronym, 0, 1) }}.

                </td>
                <td>{{ $row->beauty_date() }}</td>
                <td>{{ $row->receipt->cost }}</td>
            </tr>
        @endforeach
        <tr class="itog">
            <td>ИТОГО:</td>
            <td>{{ $countItog }}</td>
            <td></td>
            <td></td>
            <td>{{ $summ }}</td>
        </tr>

    </tbody>
</table>

<h3>Доход за заказы</h3>
<table>
    <thead>
        <th>Всего изделий, шт.</th>

        <th>Доход за заказы, руб.</th>
    </thead>
    <tbody>
        <tr>
            <td>{{ $countItog }}</td>
            <td>{{ $summ }}</td>
        </tr>
    </tbody>
</table>
@endsection
