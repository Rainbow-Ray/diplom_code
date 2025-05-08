<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новая проверка оборудования</title>
</head>
<body>

    <form action="/{{$rootURL}}" method="POST">
        @csrf
        <p>Состояние оборудования {{}}</p>
        <span>Название</span>
        <span> {{}} </span>
        <label for="date">Дата проверки</label>
        <input type="date" name="date" id="date" required>
        <label for="equip_state">Тип</label>
        <select name="equip_state">
            @foreach ($equipStates as $state)
            <option value="{{$state->id}}"> {{$state->name}}</option>
            
            @endforeach
        </select>


        <input type="submit" value="Отправить">
    </form>
</body>
</html>