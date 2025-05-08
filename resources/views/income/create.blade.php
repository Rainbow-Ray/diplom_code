@extends('index')

@section('title')
<title>Добавить доход</title>
@endsection

@section('scripts')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
    <script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script>

        $(document).ready(function () {
           $("#source").select2();            
            });
        </script>  

@endsection
@section('main')
    <form action="/{{$rootURL}}" method="POST" class="receiptForm">
        @csrf
        <h2>Добавить доход</h2>

          <div class="divSource">
            <label for="source">Источник дохода:</label>
            <select id="source" name="source">
              <option value=""></option>
              @foreach ($sources as $source)
              <option value="{{$source->id}}" >
                  {{$source->name}}
              </option>
              @endforeach
          </select>
          </div>


          <div class="divdate">

            <label for="date">Дата дохода:</label>
            <input type="datetime-local" name="date" id="date" value="{{ (new DateTime('now', new DateTimeZone('Asia/Yekaterinburg')))->format('Y-m-d H:m') }}" required>
            
            
            </div>

          <div class="divAmount">
            <label for="amount">Сумма:</label>
            <input type="money" name="amount" id="amount"> 
            <span>руб.</span>
          </div>

        <input type="submit" value="Отправить">
    </form>
@endsection


