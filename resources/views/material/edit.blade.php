@extends('index')

@section('title')
    <title>Редактировать материал</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        function appendOption(element) {
            $("#type").append(
                '<option value="' +
                element['id'] +
                '">' +
                element["name"] + ' </option>'
            );
        }

        function selectChanged() {
            var cat_id = $("#cat").find(':selected').val();
            console.log(cat_id);
            get_types(cat_id)
        }

        function get_types(cat_id) {
            fetch("http://127.0.0.1:8000/api/types/" + cat_id).then(function(response) {
                response.json().then(function(json) {
                    $("#type").empty();
                    json.forEach(element => {
                        appendOption(element);
                    });
                });
            });
        }

        $(document).ready(function() {
            $("#cat").select2();
            $("#type").select2();
            $("#ei").select2();
            $("#color").select2();
            $("#country").select2();

            $("#cat").on('change', function() {
                selectChanged();
            });
        });
    </script>
@endsection
@section('main')
    <form action="/{{ $rootURL }}/{{$item->id}}" method="POST">
        @csrf
        @method('PUT')
        <h2 class="end7">Редактировать материал</h2>

        <div class="labelTop start1  end4">
            <label for="name">Наименование:</label>
            <input type="text" name="name" id="name" value="{{ $item->name }}" required>
        </div>

        <div class="labelTop start4  end6">
            <label for="cat">Категория материала:</label>
            <select id="cat" name="cat">
                @foreach ($cats as $cat)
                    @if ($cat->id == $item->type->cat_id)
                        <option value="{{ $cat->id }}" selected>
                        @else
                        <option value="{{ $cat->id }}">
                    @endif
                    {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="labelTop start6 end7">
            <label for="type">Тип материала:</label>
            <select id="type" name="type">
                @foreach ($types as $type)
                    @if ($type->id == $item->type_id)
                        <option value="{{ $type->id }}" selected>
                        @else
                        <option value="{{ $type->id }}">
                    @endif
                    {{ $type->category->name }} / {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- <div class="labelTop">
            <label for="amount">Количество:</label>
            <input type="number" name="amount" id="amount" min='0' value="{{ $item->amount }}" required>
        </div> --}}

        {{-- <div class="labelTop">
            <label for="amount">Минимальное кол-во:</label>
            <input type="number" name="min_amount" id="min_amount" min='0' value="{{ $item->min_amount }}"
                required>
        </div> --}}

        <div class="labelTop start3 end5">
            <label for="ei">Единица измерения:</label>
            <select id="ei" name="ei">
                @foreach ($eis as $ei)
                    @if ($ei->id == $item->ei_id)
                        <option value="{{ $ei->id }}" selected>
                        @else
                        <option value="{{ $ei->id }}">
                    @endif
                    {{ $ei->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="labelTop start1 end3">
            <label for="color">Цветовая гамма:</label>
            <select id="color" name="color">
                @foreach ($colors as $color)
                    @if ($color->id == $item->color_id)
                        <option value="{{ $color->id }}" selected>
                        @else
                        <option value="{{ $color->id }}">
                    @endif
                    {{ $color->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="labelTop start3 end5">
            <label for="type">Страна производства:</label>
            <select id="country" name="country">
                @foreach ($countries as $country)
                    @if ($country->id == $item->country_id)
                        <option value="{{ $country->id }}" selected>
                        @else
                        <option value="{{ $country->id }}">
                    @endif
                    {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <input class="beautyButton submitButton end7 rstart7" type="submit" value="Отправить">
    </form>
@endsection
