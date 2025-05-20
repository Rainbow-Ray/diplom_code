@extends('index')
@section('title')
<title>Новая услуга</title>
@endsection

@section('scripts')
<script src="{{asset("assets/js/jquery-3.7.1.min.js")}}"></script>
<script src=" {{asset('assets/js/select2.min.js')}}"></script>
<script src=" {{asset('assets/js/skillAdd/skillAdd.js')}}" type="module"></script>
<link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />

@endsection
@section('main')

    <form action="/{{$rootURL}}" method="POST">
        @csrf
        <h2>Добавить услугу</h2>

        <div class="labelTop start1 end3">
            <label for="name">Наименование:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class=" start3">
            <label for="cost">Стоимость:</label>
            <input type="money" name="cost" id="cost" required>
        </div>


        <div class="start1 end4 hide receiptData">
            <h3 class="col1-5">Сотрудники, квалифицированные выполнять услугу</h3>
            <select id="skill" name="skillSelect" class="col1-3">
                @foreach ($workers as $worker)
                <option value="{{$worker->id}}" >
                    {{$worker->surname}}
                    {{$worker->name}}
                    {{$worker->patronym}} //
                    {{$worker->job->name}} 
                </option>
                @endforeach
            </select>
            <button type="button" class="addSkill start2 end3 beautyButton addButton">Добавить</button>

            <table class="col1-2">
                <tbody class="skills">
                    <tr>
                        <th>Сотрудники</th>
                    </tr>
                    </tbody>
            </table>
            <button type="button" class="deleteSkill start2 end3 beautyButton addButton">Удалить</button>

        </div>
    
        <input type="submit" class="beautyButton submitButton rstart7 end7" value="Отправить">
    </form>
    @endsection
