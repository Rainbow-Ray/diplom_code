@extends('index')
@section('title')
<title>Редактировать услуга</title>
@endsection

@section('scripts')
<script src="{{asset("assets/js/jquery-3.7.1.min.js")}}"></script>
<script src=" {{asset('assets/js/select2.min.js')}}"></script>
<script src=" {{asset('assets/js/skillAdd/skillAdd.js')}}" type="module"></script>
<link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />

@endsection
@section('main')

    <form action="/{{$rootURL}}/{{$service->id}}" method="POST">
        @csrf
        @method('PUT')

        <h2>Редактировать услугу</h2>

        <div>
            <label for="name">Наименование:</label>
            <input type="text" name="name" id="name" value="{{$service->name}}" required>
        </div>

        <div>
            <label for="cost">Стоимость:</label>
            <input type="money" name="cost" id="cost" value="{{$service->cost}}" required>
        </div>


        <div class="col1-4 receiptData">
            <h3 class="col1-5">Навыки, необходимые для выполнения услуги</h3>
            <select id="skill" name="skillSelect" class="col1-3">
                @foreach ($skills as $skill)
                <option value="{{$skill->id}}" >{{$skill->name}}</option>
                @endforeach
            </select>
            <button type="button" class="addSkill col2-3">Добавить</button>

            <table class="col1-2">
                <tbody class="skills">
                    <tr>
                        <th>Название</th>
                    </tr>
    
                    @foreach ($service->skills as $skill)
                        <tr>
                            <td id='skill{{ $skill->id }}'> {{ $skill->name }}
                            </td>
                            <td class='hide'>
                                <input type='text' name='skill[]' value='{{ $skill->id }}' readonly />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="deleteSkill col2-3">Удалить</button>

        </div>


        <input type="submit" value="Отправить">
    </form>
    @endsection
