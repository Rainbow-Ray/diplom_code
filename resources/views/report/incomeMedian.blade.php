@extends('report.report')

@section('title')
    <title>Изменение прибыли предприятия за период</title>
@endsection

@section('scripts')
@endsection
@section('main')
@section('reportHeader')
    <h3>Изменение прибыли предприятия за период</h3>
@endsection

@section('dates')
    {{ $dateS }} - {{ $dateE }}
@endsection

<h3>Прибыль</h3>
<table>
    <thead>
        <th>Дата</th>
        <th>Прибыль, руб.</th>
        <th>Разница с пред. периодом, руб.</th>
    </thead>
    <tbody>

        @for ($i = 0; $i < count($data); $i++)
            <tr>

                <td>{{ $labels[$i] }}</td>
                <td>{{ $data[$i] }}</td>
                <td>{{ $dataPerDiff[$i] }}</td>
            </tr>
        @endfor


        <tr class="itog">
            <td> ИТОГО:
            <td>{{ $itog }}</td>
        </tr>

    </tbody>
</table>


<h3>Средний доход</h3>

<table>
    <thead>
        <th>
            Средний доход за период
        </th>
        <th>
            Прирост в процентах между концом периода и средним доходом
        </th>
        <th>
            Разница между концом периода и средним доходом
        </th>
    </thead>

    <tbody>
        <td>
            {{ number_format($avgProfit, 2, ',', '') }} руб.
        </td>

        <td>
            {{ number_format($avgeDiff, 2, ',', '') }}%
        </td>
        <td>
            {{ number_format($end - $avgProfit, 2, ',', '') }} руб.
        </td>
    </tbody>

</table>

{{-- <p>Прирост в процентах между началом и концом периода: {{ number_format($seDiff, 2, ',', '') }} %</p>
<p>Прирост в процентах между концом периода и средним доходом: {{ number_format($avgeDiff, 2, ',', '') }}%,
    {{ number_format($end - $avgProfit, 2, ',', '') }} руб.</p>
<p>Средний доход за период: {{ number_format($avgProfit, 2, ',', '') }} руб.</p> --}}


<div>
    <canvas id="myChart"></canvas>
</div>







<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'line',
        data: {

            labels: {{ $labelsJ }},
            datasets: [{
                label: 'Прибыль',
                data: {{ $dataJ }},
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
