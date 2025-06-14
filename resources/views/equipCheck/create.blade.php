@extends('index')

@section('title')
<title>Новая оценка оборудования</title>
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
        <h2 class="start1 end7">Новая оценка состояния оборудования {{$equip->name}}</h2>
        <div class="labelTop start1 end3">
            <span class="cardLabel">Название</span>
            <span class="cardData"> {{$equip->name}} </span>
        </div>
        <div class="labelTop start3 end6">
            <span class="cardLabel">Инвентарный номер:</span>
            <span class="cardData"> {{$equip->number}} </span>
        </div>
        <div class="labelTop start1">
            <label for="date">Дата проверки</label>
            <input type="date" name="date" id="date" value="{{ date('Y-m-d', time()) }}" required>
        </div>
        <div class="labelTop start2 end4">
                    <label for="equip_state">Оценка</label>

            <select name="equip_state" id="equip_state">
                @foreach ($equipStates as $state)
                <option value="{{$state->id}}"> {{$state->name}}</option>
            
                @endforeach
            </select>
        </div>

        <input type="text" name="equip" id="equip" value="{{$equip->id}}" readonly class="hide">

        <input type="submit" value="Отправить" class="addButton beautyButton right rstart5 end7">
    </form>

    @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

@endsection