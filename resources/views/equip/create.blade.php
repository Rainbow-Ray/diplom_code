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
           $("#equip_type").select2();  
          
            });
        </script>  

@endsection
@section('main')
    <form action="/{{$rootURL}}" method="POST" >
        @csrf
        <h2>Добавить оборудование</h2>
        <div class="labelTop start1 end3">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" required>
        </div>
                <div class="labelTop start3">
            <label for="number">Инвентарный номер</label>
            <input type="text" name="number" id="number"" required>
        </div>

                <div class="labelTop start4 end7">
            <label for="equip_type">Тип</label>
            <select name="equip_type" id="equip_type">
                @foreach ($equipTypes as $type)
                <option value="{{$type->id}}"> {{$type->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="labelTop start1 hide">
            <label class="hide" for="count">Количество</label>
            <input class="hide" type="number" name="count" id="count" value="1" required>
        </div>


        <input type="submit" value="Отправить" class="addButton beautyButton right rstart5 end7">
    </form>
@endsection
