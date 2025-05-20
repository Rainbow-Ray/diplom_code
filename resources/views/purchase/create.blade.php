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
    <script src=" {{ asset('assets/js/request.purchase/coreItemTable.js') }}" type="module"></script>
@endsection
@section('main')
    <form action="/{{ $rootURL }}" method="POST">
        @csrf
        <h2 class="start1 end7">Добавить закупку</h2>

        <div class="">
            <label for="date">Номер закупки:</label>
            <input type="text" name="number" id="number" value="{{ $number }}" required>
        </div>
        <div class="">
            <label for="date">Дата создания:</label>
            <input type="date" name="date" id="date" value="{{ date('Y-m-d', time()) }}" required>
        </div>


        <fieldset class="filters col3 rGap start1 end7">
            <h3 class="noMargin">Фильтры:</h3>

            <div class="col3 start1 end4">
                <div>
                    <input type="radio" class="itemType" name="itemType" value="material" id="matRadio" checked>
                    <label for="matRadio">Материал</label>
                </div>
                <div>
                    <input type="radio" class="itemType" name="itemType" value="equip" id="equipRadio">
                    <label for="equipRadio">Оборудование</label>
                </div>
                <div>
                    <a class="addButtonLink addMaterial" target="_blank" href="{{ url('materials/create', []) }}">
                        <input type="button" class="addButton beautyButton" value="Добавить новый материал">
                    </a>
                    <a class="addButtonLink addEquip" target="_blank" href="{{ url('equip/create', []) }}">
                        <input type="button" class="addButton beautyButton" value="Добавить новое оборудование">
                    </a>
                </div>

                {{-- <div>
                <input type="radio" class="itemType" name="itemType" value="other" id="textRadio">
                <label for="textRadio">Ввод наименования вручную</label>
            
                </div> --}}

            </div>

            <div class=" start1 end4">
                <div class="start1 end3">
                    <div class="addMaterial col2 ">
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
                <div class="labelTop start1 end3">
                    <label for="searchItem">Поиск:</label>
                    <select id="searchItem" name="mat" class="select2">
                    </select>
                </div>


            </div>

            <div class="filterTable start1 end4">
                <table class="filterResult ">
                    <thead>
                        <th>
                            Наименование
                        </th>

                    </thead>
                    <tbody class='searchItemsTbody'>
                    </tbody>
                </table>
            </div>


            <div class="addNamedItem labelTop start1 end4">
                <label for="name">Наименование товара:</label>
                <input type="text" name="name" id="name">
            </div>

        </fieldset>

        <h3 class="editHeader hide start1 end7">Добавить купленный по запросу товар:</h3>
        <h3 class="filters start1 end7 noMargin">Добавить материал или оборудование в запрос на закупку:</h3>

        <div class="labelTop start1 end3">
        <input type="text" class="hide" id="selectedItem" value="">

            <label for="nameItem">Наименование:</label>
            <input type="text" id="itemName" readonly>
        </div>
        <div class="labelTop col2 start3 end5">
            <label for="count">Количество</label>
            <input type="number" name="count" id="count" min="0" value="1">
            <span class="start2">Ед. изм.</span>
            <span id="ei" class="start2"></span>
        </div>

        {{-- <div class="labelTop start5">
            <label for="count">Ед.измерения:</label>
            <select id="ei" name="ei" class="select2">
                @foreach ($eis as $ei)
                    <option value="{{ $ei->id }}">
                        {{ $ei->name }}
                    </option>
                @endforeach
            </select>
        </div> --}}
        <div class="labelTop start5">
            <label for="count">Цена 1 ед.</label>
            <input type="money" name="price" id="price" min="0" value="1"> руб.
        </div>
        <div class="start6 end7">
            <p class="noMargin">Сумма</p>
            <span class="summ"> 1</span>
            <span class="">руб.</span>
        </div>

        <input type="button" class="formButton left start5 hide" value="Отмена" id="cancelEdit">
        <input type="button" class="formButton left addButton beautyButton start6 end7 hide" value="Добавить товар"
            id="editSave">

        <input type="button" class="formButton right addButton beautyButton  start5 end7" value="Добавить в закупку"
            id="itemAdd">

        <h3 class="start1 end7 noMargin">Перечень товаров в закупке</h3>

        <div class="itemTable start1 end4 rstart10 rend12">
            <table class="itemTable">
                <thead>
                    <th>Наимаенование</th>
                    <th>Количество</th>
                    <th>Цена, руб.</th>
                    <th>Ед. изм.</th>
                </thead>
                <tbody class="itemPurchasedTbody">

                    @if (!is_null($req))
                        @foreach ($req->rows as $row)
                            <x-item-row :item="$row" :purchased="1" />
                        @endforeach
                    @endif

                </tbody>
            </table>

        </div>
        <input type="button" class="deleteButton beautyButton start4 rstart10" id="deleteItem" value="-">
        </div>


        <input type="submit" class="beautyButton submitButton end7 rstart11" value="Отправить">
    </form>
@endsection
