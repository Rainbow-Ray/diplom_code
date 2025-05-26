@extends('index')

@section('title')
    <title>Изменить доход</title>
@endsection

@section('scripts')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#source").select2();

        });
    </script>
@endsection
@section('main')
    <form action="/{{ $rootURL }}/{{ $income->id }}" method="POST" class="">
        @csrf
        @method('PUT')

        <h2>Изменить доход</h2>

        <div class="labelTop start1 end4">
            <label for="source">Источник дохода:</label>
            <select id="source" name="source">
                <option value=""></option>
                @foreach ($sources as $source)
                    @if ($source->id == $income->source_id)
                        <option value="{{ $source->id }}" selected>
                            {{ $source->name }}
                        </option>
                    @else
                        <option value="{{ $source->id }}">
                            {{ $source->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>



        <div class="labelTop">
            <label for="dateIn">Дата дохода:</label>
            <input type="datetime-local" name="date" id="date" value="{{ $income->date }}" required>
        </div>

        <div class="start1 end3 ">
              <label for="costAdd">Сумма:</label>
              <input type="money" name="amount" id="amount" value="{{ $income->amount }}">
          <span>руб.</span>

        </div>
        <div class="labelTop">
          <span> </span>
        </div>


        <input type="submit" class="beautyButton submitButton rstart7 end7" value="Отправить">
    </form>


    <form action="/{{ $rootURL }}/{{ $income->id }}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="beautyButton danger" value="Удалить">
    </form>
    @if ($errors->any())
        <h4>{{ $errors->first() }}</h4>
    @endif
@endsection
