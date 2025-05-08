@extends('index')
@section('title')
<title>{{$title}}</title>
@endsection

@section('scripts')
@endsection
@section('main')
    <form action="/{{$rootURL}}" method="POST">
        @csrf
        <h2>{{$formHeader}}</h2>

        <div class="labelTop">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" required>
        </div>
        <input type="submit" value="Отправить">
    </form>
    @endsection
