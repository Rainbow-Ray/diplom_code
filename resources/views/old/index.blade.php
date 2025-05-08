<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield("title")
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/style.css")}}">

    @yield("scripts")

</head>
<body>
    <header>
        <div class="logo">ИС "КлючСервис+"</div>
        {{-- <div class="logData">
            <span class="username">А.А.Иванов</span>
            <span class="logOut">Выход</span>
        </div>
        <div class="new_order">Новый заказ</div> --}}
    </header>
    <nav class="main_nav">
        <ul>
            <li><a href="http://127.0.0.1:8000/">Главная</a></li>
            <li>Справочники</li>
            <li>Отчеты</li>
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
            <li>Материалы</li>
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


            
            <ul>Справочники характеристик 
                <a href="http://127.0.0.1:8000/mat_type">
                    <li>Тип материала</li>
                </a>
                <a href="http://127.0.0.1:8000/accessories">
                    <li class="selected_dict">Тип аксуссуара</li>
                </a>
                <a href="http://127.0.0.1:8000/key_type">
                    <li>Тип ключа</li>
                </a>
                <a href="http://127.0.0.1:8000/furniture_category">
                    <li>Категория фурнитуры</li>
                </a>
                <a href="http://127.0.0.1:8000/lock_type">
                    <li>Тип замка</li>
                </a>
                <a href="http://127.0.0.1:8000/country">
                    <li>Страна производства</li>
                </a>
                <a href="http://127.0.0.1:8000/colors">
                    <li>Цветовая гамма</li>
                </a>
                <a href="http://127.0.0.1:8000/state">
                    <li>Состояние оборудования</li>
                </a>
            </ul>

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



    </main>
    <footer>
        <p>ИП А.Апакидзе</p>
    </footer>
</body>
</html>