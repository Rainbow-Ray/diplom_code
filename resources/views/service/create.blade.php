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
        <h2 class="start1 end7">Добавить услугу</h2>

        <div class="labelTop start1 end3">
            <label for="name">Наименование:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="labelTop start3 end4">
            <label for="cost">Стоимость:</label>
            <input type="money" name="cost" id="cost" required>
        </div>


        <div class="start1 end4 receiptData">
            <h3 class="col1-5">Навыки, необходимые для выполнения услуги</h3>
            <select id="skill" name="skillSelect" class="col1-3">
                @foreach ($skills as $skill)
                <option value="{{$skill->id}}" >{{$skill->name}}</option>
                @endforeach
            </select>
            <button type="button" class="addSkill col2-3">Добавить</button>

            <table class="start1 end2">
                <tbody class="skills">
                    <tr>
                        <th>Название</th>
                    </tr>
                    </tbody>
            </table>
            <button type="button" class="deleteSkill start2 end3">Удалить</button>

        </div>
    
        <input type="submit" class="beautyButton submitButton rstart3 end7"  value="Отправить">
    </form>
    @endsection
