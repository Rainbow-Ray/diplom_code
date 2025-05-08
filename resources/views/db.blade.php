<!DOCTYPE html>
<html lang="ru">      

<head>
    <meta charset="utf-8">
    <title> Брелоки </title>
      </head>
<body>
    @foreach ($users as $user)
    <p> {{ $user->name }}</p>
@endforeach
</body>
</html>