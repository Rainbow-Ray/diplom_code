<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    @yield('scripts')

</head>

<body>
    <header>
        <div class="logo">ИС "КлючСервис+"</div>

        @guest
        <a href="http://127.0.0.1:8000/login">Вход</a>
        <a href="http://127.0.0.1:8000/register">Регистрация</a>
        @endguest
        
        @auth
            <div class="logData">
                <span class="username">А.А.Иванов</span>
                <form action="http://127.0.0.1:8000/logout" method="POST">
                    @csrf
                    <input type="submit" value="Выход">
                </form>
            </div>
        @endauth


        <div class="new_order">Новый заказ</div>
    </header>
    <nav class="main_nav">
        <ul>
            <li><a href="http://127.0.0.1:8000/">Главная</a></li>
            <li>Справочники</li>
            <li><a href="http://127.0.0.1:8000/report">Отчеты</a></li>
            <li>...</li>
        </ul>
    </nav>
    <nav class="side_nav">
        <ul class="side_nav_main_ul"> Справочники
            <a href="http://127.0.0.1:8000/order">
                <li>Заказы</li>
            </a>
            <a href="http://127.0.0.1:8000/receipt">
                <li>Квитанции</li>
            </a>
            <a href="http://127.0.0.1:8000/customer">
                <li>Клиенты</li>
            </a>
            <a href="http://127.0.0.1:8000/equip">
                <li>Оборудование</li>
            </a>
            <a href="http://127.0.0.1:8000/worker">
                <li>Сотрудники</li>
            </a>
            <a href="http://127.0.0.1:8000/ei">
                <li>Единица измерения</li>
            </a>
            <a href="http://127.0.0.1:8000/job_title">
                <li>Должность</li>
            </a>
            <a href="http://127.0.0.1:8000/service">
                <li>Услуги</li>
            </a>
            <a href="http://127.0.0.1:8000/skill">
                <li>Навыки</li>
            </a>
            <a href="http://127.0.0.1:8000/income">
                <li>Доходы</li>
            </a>
            <a href="http://127.0.0.1:8000/expense">
                <li>Расходы</li>
            </a>
            <a href="http://127.0.0.1:8000/request">
                <li>Запросы на закупку</li>
            </a>
            <a href="http://127.0.0.1:8000/purchase">
                <li>Закупки</li>
            </a>

            <ul class="sec_ul">Материалы
                <a href="http://127.0.0.1:8000/materials">
                    <li class="selected_dict">Все</li>
                </a>

                <a href="http://127.0.0.1:8000/accessories">
                    <li class="selected_dict">Аксуссуары</li>
                </a>
                <a href="http://127.0.0.1:8000/key_auto">
                    <li>Автомобильные ключи</li>
                </a>
                <a href="http://127.0.0.1:8000/key_door">
                    <li>Замочные ключи</li>
                </a>
                <a href="http://127.0.0.1:8000/locks">
                    <li>Замки</li>
                </a>
                <a href="http://127.0.0.1:8000/furniture">
                    <li>Фурнитура</li>
                </a>
            </ul>
            <ul class="sec_ul">Справочники характеристик материала
                <a href="http://127.0.0.1:8000/country">
                    <li>Страна производства</li>
                </a>

                <a href="http://127.0.0.1:8000/mat_type">
                    <li>Тип материала</li>
                </a>
                <a href="http://127.0.0.1:8000/colors">
                    <li>Цветовая гамма</li>
                </a>
            </ul>

            <a href="http://127.0.0.1:8000/state">
                <li>Состояние оборудования</li>
            </a>


            <a href="http://127.0.0.1:8000/income_source">
                <li>Источник дохода</li>
            </a>
            <a href="http://127.0.0.1:8000/expense_source">
                <li>Источник расхода</li>
            </a>

        </ul>
    </nav>

    <main>

        @yield('main')

        {{-- <h1>Тип аксуссуара</h1>

        <div class="card">
            <span class="cardLabel">Тип:</span>
            <span class="cardData">Станок</span>
            <span class="cardLabel">Название:</span>
            <span class="cardData">Станок Рязань-2</span>
            <span class="cardLabel">Инвентарный номер:</span>
            <span class="cardData">СТ1002</span>
            <span class="cardLabel">Количество:</span>
            <span class="cardData">1</span>
            <a href="">
                <button>Редактировать</button>
                </a>
        </div>
        <div class="card">
            <span class="cardLabel">Тип:</span>
            <span class="cardData">Станок</span>
            <span class="cardLabel">Название:</span>
            <span class="cardData">Станок Рязань-2</span>
            <span class="cardLabel">Инвентарный номер:</span>
            <span class="cardData">СТ1002</span>
            <span class="cardLabel">Количество:</span>
            <span class="cardData">1</span>
            <a href="">
                <button>Редактировать</button>
                </a>
        </div>
        <div class="card">
            <span class="cardLabel">Тип:</span>
            <span class="cardData">Станок</span>
            <span class="cardLabel">Название:</span>
            <span class="cardData">Станок Рязань-2</span>
            <span class="cardLabel">Инвентарный номер:</span>
            <span class="cardData">СТ1002</span>
            <span class="cardLabel">Количество:</span>
            <span class="cardData">1</span>
            <a href="">
                <button>Редактировать</button>
                </a>
        </div> --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </main>
    <footer>
        <p>ИП А.Апакидзе</p>
    </footer>
</body>

</html>
