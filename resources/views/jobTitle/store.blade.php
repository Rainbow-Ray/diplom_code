<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
</head>
<body>

    <form action="/{{$rootURL}}" method="POST">
        @csrf
        <p>{{$formHeader}}</p>
        <label for="name">Название</label>
        <input type="text" name="name" id="name" required>
        <label for="name">Оклад</label>
        <input type="number" name="salary" id="salary"" required>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>