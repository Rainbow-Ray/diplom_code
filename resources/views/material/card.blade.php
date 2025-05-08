@extends('List')
@section('title')
    <title>{{$title}}</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection
@section('header')
    {{$title}}
@endsection


@section('addButton')
<a class="addButtonLink" href="{{url($createURL.'/create', [])}}">
    <button class="addButton">
        Добавить материал
    </button>
</a>
@endsection

@section('dictCard')
    @foreach ($items as $item)
        <div class="card">
            <div>
                <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">
                    <div class="itemInfo reciptInfo">
                        <span class="cardLabel">Наименование:</span>
                        <span class="cardData">{{ $item->name }}
                        </span>
                        <span class="cardLabel">Тип:</span>
                        <span class="cardData">{{ $item->type->name }}</span>

                        <span class="cardLabel">Категория:</span>
                        <span class="cardData">{{ $item->type->category->name }}</span>

                        <span class="cardLabel">Количество:</span>
                        <span class="cardData">{{ $item->amount }}</span>
                        <span class="cardLabel">Цвет:</span>
                        <span class="cardData">{{ $item->color->name }}</span>
                    </div>
                </a>
            </div>

            <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                <button>Редактировать</button>
            </a>

        </div>
    @endforeach
@endsection
