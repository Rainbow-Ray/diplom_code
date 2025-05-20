@extends('index')
@section('title')
<title>{{$title}}</title>
@endsection

@section('scripts')
@endsection
@section('main')

    <form action="/{{$rootURL}}" method="POST">
        @csrf
        <h2 class="start1 end7">{{$formHeader}}</h2>
        <div class="labelTop start1">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="labelTop">
            <label for="name">Оклад</label>
            <input type="number" name="salary" id="salary"" required>
        </div>
        <input type="submit" class="beautyButton submitButton rstart3 end7" value="Отправить">
    </form>
@endsection
