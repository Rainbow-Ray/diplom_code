@extends('index')

@section('title')
<title>Редактировать тип материала</title>
@endsection

@section('scripts')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
    <script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script src=" {{asset('assets/js/select2.min.js')}}"></script>
    <script>

        $(document).ready(function () {
           $("#category").select2();            
            });
        </script>  

@endsection
@section('main')
    <form action="/{{$rootURL}}/{{$type->id}}" method="POST">
        @csrf
        @method('PUT')
        <h2>Редактировать тип материала</h2>

          <div class="labelTop start1 end3">
            <label for="category">Категория материала:</label>
            <select id="category" name="category">
              @foreach ($category as $cat)
              @if ($cat->id == $type->cat_id)
              <option value="{{$cat->id}}" selected>
                {{$cat->name}}
            </option>

              @else
              <option value="{{$cat->id}}" >
                {{$cat->name}}
            </option>
              @endif
              @endforeach
          </select>
          </div>

          <div class="labelTop start3 end5">
            <label for="name">Наименование:</label>
            <input type="text" name="name" id="name" value="{{$type->name}}" required>
            </div>

        <input type="submit" class="beautyButton submitButton start6 rstart3" value="Отправить">
    </form>
@endsection


