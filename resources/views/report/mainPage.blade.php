@extends('List')
@section('title')
    <title>Отчёты</title>
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
Отчёты
@endsection

@section('addButton')
@endsection

@section('dictCard')
<div>
    <h2>Доходы и расходы предприятия за период</h2>
    <p></p>
    <a href="http://127.0.0.1:8000/report/incomes"><button>Сфоромировать</button></a>
</div>
<div>
    <h2>Доход за заказы</h2>
    <p></p>
    <a href="http://127.0.0.1:8000/report/orderIncome"><button>Сфоромировать</button></a>
</div>
<div>
    <h2>Затраченные материалы за период </h2>
    <p></p>
    <a href="http://127.0.0.1:8000/report/orderMaterial"><button>Сфоромировать</button></a>
</div>
<div>
    <h2>Количество выполненных заказов на мастера   </h2>
    <p></p>
    <a href="http://127.0.0.1:8000/report/worker"><button>Сфоромировать</button></a>
</div>
<div>
    <h2>Постоянные клиенты    </h2>
    <p></p>
    <a href="http://127.0.0.1:8000/report/customer"><button>Сфоромировать</button></a>
</div>
<div>
    <h2>Изменение прибыли предприятия за период </h2>
    <p></p>
    <a href="http://127.0.0.1:8000/report/incomeMedian"><button>Сфоромировать</button></a>
</div>




 
@endsection
