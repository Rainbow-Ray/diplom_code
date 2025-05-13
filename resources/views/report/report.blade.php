<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield("title")
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/report.css")}}">

    @yield("scripts")

</head>

<body>
    <main>
        <h1>@yield('reportHeader')</h1>
        <span>Период: @yield('dates')</span>
            @yield('main')    
    </main>
    
</body>
</html>