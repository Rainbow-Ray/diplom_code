@extends('index')

@section('title')
    <title>Добавить материал</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/material/materialCreateJs.js') }}" type="module"></script>

@endsection
@section('main')
    <form action="/{{ $rootURL }}" method="POST">
        @csrf
        <h2 class="end7">Добавить материал</h2>

        <div class="labelTop start1  end4">
            <label for="name">Наименование:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="labelTop start4  end6">
            <label for="cat">Категория материала:</label>
            <select id="cat" name="cat">
                @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}">
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="labelTop start6 end7">
            <label for="type">Тип материала:</label>
            <select id="type" name="type">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->category->name }} / {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- <div class="labelTop">
            <label for="amount">Количество:</label>
            <input type="number" name="amount" id="amount" min='0' value="0" required>
        </div>

        <div class="labelTop">
            <label for="amount">Минимальное кол-во:</label>
            <input type="number" name="min_amount" id="min_amount" min='0' value="0" required>
        </div> --}}

        <div class="labelTop start1 end3">
            <label for="ei">Единица измерения:</label>
            <select id="ei" name="ei">
                @foreach ($eis as $ei)
                    <option value="{{ $ei->id }}">
                        {{ $ei->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="labelTop start3 end5">
            <label for="color">Цветовая гамма:</label>
            <select id="color" name="color">
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}">
                        {{ $color->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="labelTop start5 end7">
            <label for="type">Страна производства:</label>
            <select id="country" name="country">
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <input class="beautyButton submitButton end7 rstart7" type="submit" value="Отправить">
    </form>
@endsection
