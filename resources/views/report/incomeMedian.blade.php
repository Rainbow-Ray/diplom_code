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
{{$dateS}} - {{$dateE}}
@endsection

<h3>Прибыль</h3>
<table>
    <thead>
        <th>Месяц </th>
        <th>Прибыль</th>
    </thead>
    <tbody>

        @for ($i = 0; $i < count($data); $i++)
        <tr>

            <td>{{$labels[$i]}}</td>
            <td>{{$data[$i]}}</td>
        </tr>

            @endfor


        <tr class="itog">
            <td> ИТОГО:
            <td>{{$itog}}</td>
        </tr>

    </tbody>
</table>

<p>Прирост в процентах между началом и концом периода: {{$seDiff}} %</p>
<p>Прирост в процентах между концом периода и средним доходом: {{$avgeDiff}}%, {{$end - $avgProfit}} руб.</p>
<p>Средний доход за период: {{$avgProfit}} руб.</p>


<div>
    <canvas id="myChart"></canvas>
  </div>






  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'line',
      data: {
        
        labels: {{ $labelsJ}},
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
