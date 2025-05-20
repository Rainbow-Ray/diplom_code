@extends('index')
@section('title')
<title>Редактировать данные пользователя</title>
@endsection

@section('scripts')
<script src="{{asset("assets/js/jquery-3.7.1.min.js")}}"></script>
<script src=" {{asset('assets/js/select2.min.js')}}"></script>
<script src=" {{asset('assets/js/skillAdd/skillAdd.js')}}" type="module"></script>
<link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />

@endsection
@section('main')

    <form action="/{{$rootURL}}/{{$user->id}}" method="POST">
        @csrf
        @method('PUT')

        <h2>Редактировать данные пользователя</h2>

        <div class="labelTop start1">
            <label for="name">Email:</label>
            <input type="email" name="email" id="email" value="{{$user->email}}" required>
        </div>

        <div class="labelTop">
            <label for="cost">Имя:</label>
            <input type="text" name="name" id="name" value="{{$user->name}}" required>
        </div>
                    <input type="text" class="hide" readonly name="roleEdit" value="0">
        <input type="submit" class="beautyButton submitButton end7" value="Отправить">
    </form>
    @endsection
