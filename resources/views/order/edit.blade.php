@extends('index')
@section('title')
<title>Изготовлено по заказу</title>
@endsection

@section('scripts')
@endsection
@section('main')

<h2>{{$order->service->name}}</h2>

<x-order-card :order="$order"/>
    <form action="/{{$rootURL}}/{{$order->id}}" method="POST">
        @csrf
        @method('PUT')
        <h2>Добавить готовые изделия</h2>
        <div>
            <label for="countDone">Изготовлено:</label>
            <input type="number" name="countDone" id="countDone" required>
        </div>
        <div>
            <label for="isDone">Готово к выдаче:</label>
            <input type="checkbox" name="isDone" id="isDone">
        </div>

        <input type="submit" value="Сохранить">
    </form>

    @endsection
