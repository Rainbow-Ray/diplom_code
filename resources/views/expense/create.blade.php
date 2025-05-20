@extends('index')

@section('title')
<title>Добавить расход</title>
@endsection

@section('scripts')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
    <script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script>

        $(document).ready(function () {
           $("#source").select2();  
           $("#worker").select2();            
          
            });
        </script>  

@endsection
@section('main')
    <form action="/{{$rootURL}}" method="POST" class="">
        @csrf
        <h2>Добавить расход</h2>

          <div class="labelTop start1 end4">
            <label for="source">Источник расхода:</label>
            <select id="source" name="source">
              <option value=""></option>
              @foreach ($sources as $source)
              <option value="{{$source->id}}" >
                  {{$source->name}}
              </option>
              @endforeach
          </select>
          </div>

          <div class="labelTop">
            <label for="worker">Целевой сотрудник:</label>
            <select id="worker" name="worker">
              <option value=""> 
                
              </option>
              @foreach ($workers as $worker)
              <option value="{{$worker->id}}" >
                  {{$worker->surname}} {{$worker->name}} {{$worker->patronym}}
              </option>
              @endforeach
          </select>
          </div>


          <div class="labelTop">
            <label for="date">Дата расхода:</label>
            <input type="date" name="date" id="date" value="{{ (new DateTime('now', new DateTimeZone('Asia/Yekaterinburg')))->format('Y-m-d') }}" required>
            </div>

          <div class="start1 end3">
            <label for="amount">Сумма:</label>
            <input type="money" name="amount" id="amount"> 
            <span>руб.</span>
          </div>

        <input type="submit" class="beautyButton submitButton rstart3 end7" value="Отправить">
    </form>
@endsection


