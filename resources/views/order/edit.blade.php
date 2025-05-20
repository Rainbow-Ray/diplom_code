@extends('index')
@section('title')
<title>Изготовлено по заказу</title>
@endsection

@section('scripts')
@endsection
@section('main')
<div class="mainHeader">    
    <h1>    
{{$order->service->name}}
    </h1>
</div>



<x-order-card :order="$order"/>
    <form action="/{{$rootURL}}/{{$order->id}}" method="POST">
        @csrf
        @method('PUT')
        <h2>Добавить готовые изделия</h2>
        <div class="start1 labelTop">
            <label for="countDone">Изготовлено:</label>
            <input type="number" name="countDone" id="countDone" required>
        </div>
        <div class="">
            <label for="isDone">Готово к выдаче:</label>
            <input type="checkbox" name="isDone" id="isDone">
        </div>

        <input type="submit" class="beautyButton submitButton end7" value="Сохранить">
    </form>

    @endsection
