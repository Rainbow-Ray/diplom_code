@extends('index')

@section('title')
    <title>Добавить запрос на закупку</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/request.purchase/requestEdit.js') }}" type="module"></script>
    <script src=" {{ asset('assets/js/request.purchase/coreItemTable.js') }}" type="module"></script>
@endsection
@section('main')
    <form action="/{{ $rootURL }}/{{ $item->id }}" method="POST">
        @csrf
        @method('PUT')
        <h2 class="start1 end7">Добавить запрос</h2>

        <div class="">
            <label for="date">Номер:</label>
            <input type="text" name="number" id="number" value="{{ $item->number }}" required>
        </div>

        <div class="">
            <label for="dateCreated">Дата создания:</label>
            <input type="date" name="dateCreated" id="dateCreated" value="{{ $item->dateCreated }}" required>
        </div>
        <div>
            <label for="dateClosed">Дата закрытия:</label>
            <input type="date" name="dateClosed" id="dateClosed" value="{{ date('Y-m-d', time()) }}" required>
        </div>

        <div class="">
            <label for="isUrgent">Срочно</label>
            @if ($item->isUrgent == 1)
                <input type="checkbox" name="isUrgent" id="isUrgent" checked>
            @else
                <input type="checkbox" name="isUrgent" id="isUrgent">
            @endif
        </div>

        <div class="">
            <label for="isDone">Запрос выполнен</label>
            @if ($item->isDone == 1)
                <input type="checkbox" name="isDone" id="isDone" checked>
            @else
                <input type="checkbox" name="isDone" id="isDone">
            @endif
        </div>


        <div class="divworker">
            <label for="selectWorker">Создал:</label>
            <select id="selectWorker" class="select2" name="worker">
                <option value=""></option>
                @foreach ($workers as $worker)
                    @if ($item->worker_id == $worker->id)
                        <option value="{{ $worker->id }}" selected>
                        @else
                        <option value="{{ $worker->id }}">
                    @endif

                    {{ $worker->surname . ' ' . $worker->name . ' // ' . $worker->job->name }}
                    </option>
                @endforeach
            </select>
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
                    <div class="addMaterial col2">
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
                <table class="filterResult">
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
                <label for="name">Наименование запрашиваемого товара:</label>
                <input type="text" name="name" id="name">
            </div>

        </fieldset>
        <p class="start1 end7 noMargin">Добавить материал или оборудование в запрос на закупку:</p>


        <div class="labelTop start1 end4">
            <label for="nameItem">Наименование:</label>
            <input type="text" id="itemName" readonly>
        </div>
        <div class="labelTop col2 start4 end6">
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
        </div>
 --}}
        <input type="button" class="formButton addButton beautyButton leftButton start6" value="Добавить"
            id="itemAdd">

        <div class="itemTable start1 end4">
            <table class="itemTable">
                <caption>Товары к закупке:</caption>
                <thead>
                    <th>Материал/Фурнитура</th>
                    <th>Количество</th>
                    <th>Ед. изм.</th>
                </thead>
                <tbody class="itemTbody">

                    @foreach ($item->rows as $row)
                        <x-item-row :item="$row" :purchased="false" />
                    @endforeach

                </tbody>
            </table>
        </div>
        <input type="button" class="deleteButton beautyButton  start4" id="deleteItem" value="-">
        </div>


        <input type="submit" class="beautyButton submitButton rstart11 end7" value="Отправить">
    </form>
    <hr>
    <form action="/{{ $rootURL }}/{{ $item->id }}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="beautyButton danger rstart7" value="Удалить">
    </form>
    @if ($errors->any())
        <h4>{{ $errors->first() }}</h4>
    @endif
@endsection
