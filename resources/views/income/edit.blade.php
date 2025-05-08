@extends('index')

@section('title')
<title>Изменить доход</title>
@endsection

@section('scripts')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
    <script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
           $("#service").select2();

        });
        </script>        
@endsection
@section('main')
    <form action="/{{$rootURL}}/{{$income->id}}" method="POST" class="receiptForm">
        @csrf
        @method('PUT')

        <h2>Изменить доход</h2>

        <div class="divSource">
            <label for="source">Источник дохода:</label>
            <select id="source" name="source">
              <option value=""></option>
              @foreach ($sources as $source)
              @if ($source->id == $income->source_id)
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



          <div class="divdateIn">
            <label for="dateIn">Дата дохода:</label>
            <input type="datetime-local" name="dateIn" id="dateIn" value="{{$income->date}}" required>
          </div>

          <div class="divcostAdd">
            <label for="costAdd">Сумма:</label>
            <input type="money" name="costAdd" id="costAdd" value="{{$income->amount}}"> 
            <span>руб.</span>
          </div>

        <input type="submit" value="Отправить">
    </form>


    <form action="/{{$rootURL}}/{{$income->id}}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" value="Удалить">
    </form>
    @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif


@endsection