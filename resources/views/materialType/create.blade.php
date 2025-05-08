@extends('index')

@section('title')
<title>Добавить тип материала</title>
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
    <form action="/{{$rootURL}}" method="POST" class="receiptForm">
        @csrf
        <h2>Добавить тип материала</h2>

          <div class="divCat">
            <label for="category">Категория материала:</label>
            <select id="category" name="category">
              @foreach ($category as $cat)
              <option value="{{$cat->id}}" >
                  {{$cat->name}}
              </option>
              @endforeach
          </select>
          </div>

          <div class="divName">
            <label for="name">Наименование:</label>
            <input type="text" name="name" id="name" required>
            </div>

        <input type="submit" value="Отправить">
    </form>
@endsection


