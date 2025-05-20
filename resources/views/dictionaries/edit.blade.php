@extends('index')
@section('title')
<title>{{$title}}</title>
@endsection

@section('scripts')
@endsection
@section('main')
    <form action="/{{$rootURL}}/{{$id}}" method="POST">
        @csrf
        @method('PUT')
        <h2 class="start1 end7">{{$formHeader}}</h2>

        <div class="labelTop start1 end3">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" value="{{$name}}" required>
        </div>
        <input type="submit" class="beautyButton submitButton rstart3 end7" value="Отправить">
    </form>

    <form action="/{{$rootURL}}/{{$id}}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="beautyButton danger" value="Удалить">
    </form>

    @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
@endsection
