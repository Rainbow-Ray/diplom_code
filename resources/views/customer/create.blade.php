@extends('index')
@section('title')
<title>Новый клиент</title>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/imask.js')}}"></script>
    <script src="{{asset("assets/js/jquery-3.7.1.min.js")}}"></script>
    <script src="{{asset('assets/js/phoneMask.js')}}"></script>
@endsection
@section('main')

    <form action="/{{$rootURL}}" method="POST">
        @csrf
        <h2>Добавить данные клиента</h2>

        <div>
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="surname">Фамилия</label>
            <input type="text" name="surname" id="surname" required>
        </div>
        <div>
            <label for="patronym">Отчество</label>
            <input type="text" name="patronym" id="patronym">
        </div>
        <div>
            <label for="phone">Телефон </label>
            <input type="text"  placeholder="8(000)000-00-00" name="phone" id="phone" required>
        </div>
        <div class="divDiscount">
            <label for="discount">Скидка</label>
            <input type="number" name="discount" id="discount" min="0" max="99" value="0">
            <span>%</span>
        </div>

        <input type="submit" value="Отправить">
    </form>
    @endsection
