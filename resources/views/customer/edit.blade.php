@extends('index')
@section('title')
<title>Редактировать данные клиента</title>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/imask.js')}}"></script>
    <script src="{{asset("assets/js/jquery-3.7.1.min.js")}}"></script>
    <script src="{{asset('assets/js/phoneMask.js')}}"></script>
@endsection
@section('main')

    <form action="/{{$rootURL}}/{{$customer->id}}" method="POST">
        @csrf
        @method('PUT')

        <h2>Редактировать данные клиента</h2>

        <div>
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" value="{{$customer->name}}" required>
        </div>

        <div>
            <label for="surname">Фамилия</label>
            <input type="text" name="surname" id="surname" value="{{$customer->surname}}" required>
        </div>
        <div>
            <label for="patronym">Отчество</label>
            <input type="text" name="patronym" value="{{$customer->patronym}}" id="patronym">
        </div>
        <div>
            <label for="phone">Телефон </label>
            <input type="text"  placeholder="8(000)000-00-00" name="phone" id="phone" value="{{$customer->phone}}" required>
        </div>
        <div class="divDiscount">
            <label for="discount">Скидка</label>
            <input type="number" name="discount" id="discount" min="0" max="99" value="{{$customer->discount}}">
            <span>%</span>
        </div>

        <input type="submit" value="Отправить">
    </form>

    <form action="/{{$rootURL}}/{{$customer->id}}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" value="Удалить">
    </form>
    @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

    @endsection
