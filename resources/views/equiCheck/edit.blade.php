<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактировать оборудование</title>
</head>
<body>

    <form action="/{{$rootURL}}/{{$equip->id}}" method="POST">
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
    @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

</body>
</html>