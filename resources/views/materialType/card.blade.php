@extends('List')
@section('title')
    <title>Тип материала</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection
@section('header')
    Тип материала
@endsection


@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Добавить тип материала
    </button>
</a>
@endsection

@section('dictCard')


    @foreach ($items as $item)
        <div class="card">
                    <div class="itemInfo info3">
                        <span class="cardLabel">Наименование:</span>
                        <span class="cardData">{{ $item->name }}
                        </span>
                        <span class="cardLabel">Категория:</span>
                        <span class="cardData">{{ $item->category->name }}</span>
                    </div>

            <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
            </a>

        </div>
    @endforeach
@endsection
