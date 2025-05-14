@extends('index')

@section('title')
<title>Добавить оборудование</title>
@endsection

@section('scripts')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
    <script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script>

        $(document).ready(function () {
           $("#equip_state").select2();  
          
            });
        </script>  

@endsection
@section('main')


    <form action="/{{$rootURL}}" method="POST">
        @csrf
        <p>Состояние оборудования {{$equip->name}}</p>
        <span>Название</span>
        <span> {{$equip->name}} </span>
        <label for="date">Дата проверки</label>
        <input type="date" name="date" id="date" value="{{ date('Y-m-d', time()) }}" required>
        <label for="equip_state">Тип</label>
        <select name="equip_state" id="equip_state">
            @foreach ($equipStates as $state)
            <option value="{{$state->id}}"> {{$state->name}}</option>
            
            @endforeach
        </select>

        <input type="text" name="equip" id="equip" value="{{$equip->id}}" readonly class="hide">

        <input type="submit" value="Отправить">
    </form>
@endsection
