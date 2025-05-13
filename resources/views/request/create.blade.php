@extends('index')

@section('title')
    <title>Добавить запрос на закупку</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/request.purchase/requestCreate.js') }}" type="module"></script>
@endsection
@section('main')
    <form action="/{{ $rootURL }}" method="POST">
        @csrf
        <h2 class="start1 end7">Добавить запрос</h2>

        <div class="">
            <label for="dateCreated">Дата создания:</label>
            <input type="date" name="dateCreated" id="dateCreated" value="{{ date('Y-m-d', time()) }}" required>
        </div>

        <div class="">
            <label for="isUrgent">Срочно</label>
            <input type="checkbox" name="isUrgent" id="isUrgent">

        </div>


        <div class="divworker">
            <label for="selectWorker">Создал:</label>
            <select id="selectWorker" class="select2" name="worker">
                <option value=""></option>
                @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}">
                        {{ $worker->surname . ' ' . $worker->name . ' // ' . $worker->job->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <h3 class="start1 end7 noMargin">Заказ</h3>
        <p class="start1 end7 noMargin">Добавить материал или оборудование в запрос на закупку:</p>

        <div class="columns3 start1 end5">
            <div>
                <input type="radio" class="itemType" name="itemType" value="material" id="matRadio" checked>
                <label for="matRadio">Материал</label>
            </div>
            <div>
                <input type="radio" class="itemType" name="itemType" value="equip" id="equipRadio">
                <label for="equipRadio">Оборудование</label>
            </div>
            <div>
                <input type="radio" class="itemType" name="itemType" value="other" id="textRadio">
                <label for="textRadio">Ввод наименования вручную</label>
            </div>

        </div>

        <div class="filterBox start1 end7">
            <div class="start1 end6">
                <div class="addMaterial">
                    <div class="labelTop">
                        <label for="cat">Категория материала:</label>
                        <select id="cat" name="cat" class="select2">
                            <option value="">Все</option>
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="labelTop">
                        <label for="type">Тип материала:</label>
                        <select id="type" name="type" class="select2">
                            <option value="">Все</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->category->name }} / {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="addEquip">
                    <div class="labelTop">
                        <label for="equipCat">Категория оборудования:</label>
                        <select id="equipCat" name="equipCat" class="select2">
                            <option value="">Все</option>
                            @foreach ($equipCat as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="labelTop start1 end7">
                <label for="searchItem">Поиск:</label>
                <select id="searchItem" name="mat" class="select2">
                </select>
            </div>


        </div>

        <table class="filterResult start1 end4">
            <thead>
                <th>
                    Наименование
                </th>

            </thead>
            <tbody class='searchItemsTbody'>
            </tbody>
        </table>
        <div class="addNamedItem labelTop start1 end4">
            <label for="name">Наименование запрашиваемого товара:</label>
            <input type="text" name="name" id="name">
        </div>


        <div class="labelTop start1 end4">
            <label for="nameItem">Наименование:</label>
            <input type="text" id="itemName" readonly>
        </div>
        <div class="labelTop start4">
            <label for="count">Количество</label>
            <input type="number" name="count" id="count" min="0" value="1">
        </div>
        <div class="labelTop start5">
            <label for="count">Ед.измерения:</label>
            <select id="ei" name="ei" class="select2">
                @foreach ($eis as $ei)
                    <option value="{{ $ei->id }}">
                        {{ $ei->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="button" class="formButton leftButton start6" value="Добавить" id="itemAdd">

        <div class="itemTable start1 end4 rstart9 rend12">
            <table class="itemTable">
                <caption>Товары к закупке:</caption>
                <thead>
                    <th>Материал/Фурнитура</th>
                    <th>Количество</th>
                    <th>Ед. изм.</th>
                </thead>
                <tbody class="itemTbody">

                </tbody>
            </table>

        </div>
        <input type="button" class="deleteButton start4" id="deleteItem" value="-">
        </div>


        <input type="submit" class="beautyButton submitButton end7 rstart11" value="Отправить">
    </form>
@endsection


@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
