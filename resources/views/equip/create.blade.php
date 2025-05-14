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
    <form action="/{{$rootURL}}" method="POST" class="receiptForm">
        @csrf
        <p>Добавить оборудование</p>
        <label for="name">Название</label>
        <input type="text" name="name" id="name" required>
        <label for="count">Количество</label>
        <input type="number" name="count" id="count"" required>
        <label for="number">Инвентарный номер</label>
        <input type="text" name="number" id="number"" required>
        <label for="equip_type">Тип</label>
        <select name="equip_type" id="equip_type">
            @foreach ($equipTypes as $type)
            <option value="{{$type->id}}"> {{$type->name}}</option>

            @endforeach
        </select>


        <input type="submit" value="Отправить">
    </form>
@endsection
