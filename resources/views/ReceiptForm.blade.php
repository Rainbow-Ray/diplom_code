<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новая квитанция</title>
</head>
<body>
    <form action="" method="post">
        @csrf
        <p>Клиент</p>
        <label for="fio">ФИО</label>
        <label for="phone">ТЕЛ.</label>
        <input type="text" name="fio" id="fio">
        <input type="text" name="phone" id="phone">


    </form>
</body>
</html>