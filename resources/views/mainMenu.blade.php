@extends('index')

@section('title')
<title>
    Главное меню
</title>
@endsection



@section('main')
<div class="mainHeader">  
    <h1>Главное меню</h1>  



</div>
<div>
    <h2>Готовы к выдаче</h2>

    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



    @foreach ($receipt as $item)
    {{-- {{$receipt}} --}}
    {{$item->item}}
    {{$item->surname}}
    {{$item->name}}
    {{$item->patronym}}
    {{$item->phone}}
    <a href="http://127.0.0.1:8000/receipt/{{$item->id}}">Квитанция</a>
    @endforeach
</div>


@endsection
