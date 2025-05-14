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

    <form action="/{{$rootURL}}/{{$equip->id}}" method="POST" class="receiptForm">
        @csrf
        @method('PUT')

        <p>Редактировать оборудование</p>
        <label for="name">Название</label>
        <input type="text" name="name" id="name" value="{{$equip->name}}" required>
        <label for="count">Количество</label>
        <input type="number" name="count" id="count"  value="{{$equip->count}}" required>
        <label for="number">Инвентарный номер</label>
        <input type="text" name="number" id="number"  value="{{$equip->number}}" required>
        <label for="equip_type">Тип</label>
        <select name="equip_type">
            @foreach ($equipTypes as $type)
            @if ($equip->equipType -> id == $type->id)
            <option value="{{$type->id}}" selected> {{$type->name}}</option>

            @else
            <option value="{{$type->id}}"> {{$type->name}}</option>

            @endif

            @endforeach
        </select>
        <input type="submit" value="Отправить">
    </form>

    <form action="/{{$rootURL}}/{{$equip->id}}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" value="Удалить">
    </form>

@endsection
