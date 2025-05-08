<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новый клиент</title>
</head>
<body>
    <form action="" method="post">
        @csrf
        <p>Клиент</p>
        <label for="surname">Фамилия</label>
        <input type="text" name="name" id="name">

        <label for="name">Имя</label>  
        <input type="text" name="surname" id="surname">

        <label for="patronym">Отчество</label>
        <input type="text" name="patronym" id="patronym">

        <br>
        <br>
        <label for="phone">Телефон</label>
        <input type="phone" name="phone" id="phone">

        <input type="submit" value="Отправить">

    </form>
</body>
</html>