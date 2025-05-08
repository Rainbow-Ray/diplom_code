<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить оборудование</title>
</head>
<body>

    <form action="/{{$rootURL}}" method="POST">
        @csrf
        <p>Добавить оборудование</p>
        <label for="name">Название</label>
        <input type="text" name="name" id="name" required>
        <label for="count">Количество</label>
        <input type="number" name="count" id="count"" required>
        <label for="number">Инвентарный номер</label>
        <input type="text" name="number" id="number"" required>
        <label for="equip_type">Тип</label>
        <select name="equip_type">
            @foreach ($equipTypes as $type)
            <option value="{{$type->id}}"> {{$type->name}}</option>

            @endforeach
        </select>


        <input type="submit" value="Отправить">
    </form>
</body>
</html>