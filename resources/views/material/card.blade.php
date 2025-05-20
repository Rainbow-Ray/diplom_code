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
    <button class="addButton beautyButton">
        Добавить материал
    </button>
</a>
@endsection

@section('dictCard')
    @foreach ($items as $item)
        <div class="card">
            <div>
                    <div class="itemInfo info5 material">
                        <span class="cardLabel start1 ">Наименование:</span>
                        <span class="cardData start1 ">{{ $item->name }}
                        </span>
                        <span class="cardLabel ">Тип:</span>
                        <span class="cardData ">{{ $item->type->name }}</span>

                        <span class="cardLabel ">Категория:</span>
                        <span class="cardData ">{{ $item->type->category->name }}</span>

                        <span class="cardLabel">Ед. измерения:</span>
                        <span class="cardData">{{ $item->ei->name }}</span>
                        <span class="cardLabel">Цвет:</span>
                        <span class="cardData">{{ $item->color->name }}</span>
                    </div>
            </div>

            <a href="{{ url($rootURL . '/' . strval($item->id) . '', []) }}">
                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
            </a>

        </div>
    @endforeach
@endsection
