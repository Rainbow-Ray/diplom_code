@extends('index')

@section('title')
<title>Редактировать расход</title>
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
    <form action="/{{$rootURL}}/{{$expense->id}}" method="POST" class="">
        @csrf
        @method('PUT')

        <h2>Редактировать расход</h2>

          <div class="labelTop start1 end4">
            <label for="source">Источник расхода:</label>
            <select id="source" name="source">
              <option value=""></option>
              @foreach ($sources as $source)
              @if ($source->id == $expense->source_id)
              <option value="{{$source->id}}" selected >
                  {{$source->name}}
              </option>
              @else
              <option value="{{$source->id}}" >
                {{$source->name}}
            </option>
              @endif
              @endforeach
          </select>
          </div>

          <div class="divSource">
            <label for="worker">Целевой сотрудник:</label>
            <select id="worker" name="worker">
              <option value=""></option>
              @foreach ($workers as $worker)
              @if ($source->id == $expense->source_id)
              <option value="{{$worker->id}}" selected>
                {{$worker->surname}} {{$worker->name}} {{$worker->patronym}}
            </option>
            @else
              <option value="{{$worker->id}}" >
                  {{$worker->surname}} {{$worker->name}} {{$worker->patronym}}
              </option>
              @endif
              @endforeach
          </select>
          </div>


          <div class="labelTop">
            <label for="date">Дата расхода:</label>
            <input type="date" name="date" id="date" value="{{$expense->date}}" required>
            </div>

          <div class="start1 end3">
            <label for="amount">Сумма:</label>
            <input type="money" name="amount" id="amount" value="{{$expense->amount}}"> 
            <span>руб.</span>
          </div>

        <input type="submit" class="beautyButton submitButton rstart3 end7" value="Отправить">
    </form>
@endsection


