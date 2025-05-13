@extends('index')

@section('title')
    <title>Добавить закупку</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/request.purchase/purchaseCreate.js') }}" type="module"></script>
@endsection
@section('main')
    <form action="/{{ $rootURL }}" method="POST">
        @csrf
        <h2 class="start1 end7">Добавить закупку</h2>

        <div class="">
            <label for="date">Дата создания:</label>
            <input type="date" name="date" id="date" value="{{ date('Y-m-d', time()) }}" required>
        </div>

        <h3 class="start1 end7 noMargin">Перечень товаров</h3>
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
            <label for="name">Наименование товара:</label>
            <input type="text" name="name" id="name">
        </div>

        <h3 class="editHeader hide start1 end7">Добавить купленный по запросу товар:</h3>

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
        <div class="labelTop start6">
            <label for="count">Цена 1 ед.</label>
            <input type="money" name="price" id="price" min="0" value="1">  руб.
        </div>
        <div class="start6 end7">
            <p class="noMargin">Сумма</p>
            <span class="summ"> 1</span>
            <span class="">руб.</span>
        </div>

        <input type="button" class="formButton leftButton start5 hide" value="Отмена" id="cancelEdit">
        <input type="button" class="formButton leftButton start6 end7 hide" value="Добавить товар" id="editSave">

        <input type="button" class="formButton leftButton start6 end7" value="Добавить" id="itemAdd">


        <div class="itemTable start1 end4 rstart10 rend12">
            <table class="itemTable">
                <caption>Товары:</caption>
                <thead>
                    <th>Материал/Фурнитура</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Ед. изм.</th>
                </thead>
                <tbody class="itemPurchasedTbody">

                    @if(!is_null($req))
                    @foreach($req->rows as $row)
                    <x-item-row :item="$row" :purchased="1" />
                    @endforeach
                    @endif

                </tbody>
            </table>

        </div>
        <input type="button" class="deleteButton start4 rstart10" id="deleteItem" value="-">
        </div>


        <input type="submit" class="beautyButton submitButton end7 rstart11" value="Отправить">
    </form>
@endsection
