@extends('index')
@section('title')
<title>Изменить сотрудника</title>
@endsection

@section('scripts')
<script src="{{asset('assets/js/imask.js')}}"></script>
<script src="{{asset("assets/js/jquery-3.7.1.min.js")}}"></script>
<script src="{{asset('assets/js/phoneMask.js')}}"></script>
<script src=" {{asset('assets/js/select2.min.js')}}"></script>
<script src=" {{asset('assets/js/skillAdd/skillAdd.js')}}" type="module"></script>
<link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />

@endsection
@section('main')
<h1>Изменить данные сотрудника</h1>
    <form action="/{{$rootURL}}/{{$worker->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="workerFIO col1-3">
            <label for="surname">ФИО</label>
            <input type="text" name="surname" id="surname" value="{{$worker->surname}}" required>
            <input type="text" name="name" id="name" value="{{$worker->name}}" required>
            <input type="text" name="patronym" value="{{$worker->patronym}}" id="patronym">
        </div>
        <div class="col3-4">
            <label for="dateBirth">Дата рождения </label>
            <input type="date"  name="dateBirth" id="dateBirth" value="{{$worker->dateBirth}}" required>
        </div>

        <div class="col1-4">
            <div>
                <label for="passSerie">Серия паспорта </label>
                <input type="text" placeholder="1234" name="passSerie" id="passSerie" value="{{$worker->passSerie}}" >
            </div>
            <div>
                <label for="passNum">Номер паспорта </label>
                <input type="text" placeholder="123456" name="passNum" id="passNum" value="{{$worker->passNum}}">
            </div>
            <div>
                <label for="datePass">Дата выпуска паспорта </label>
                <input type="date" name="datePass" id="datePass" value="{{$worker->datePass}}">
            </div>
        </div>

        <div class="col1-4">
            <div>
                <label for="addrPass">Адрес прописки </label>
                <input type="text"  name="addrPass" id="addrPass" value="{{$worker->addrPass}}">
            </div>
            <div>
                <label for="addrFact">Адрес факт. проживания </label>
                <input type="text"  name="addrFact" id="addrFact" value="{{$worker->addrFact}}">
            </div>
        </div>

        <div class="col1-2">
            <label for="job">Должность</label>
            <select id="job" name="job">
                @foreach ($jobs as $job)

                @if ($job->id == $worker->job_id)
                    <option value="{{$job->id}}"  selected >{{$job->name.'| '.$job->salary}}</option>
                @else
                <option value="{{$job->id}}">{{$job->name.'| '.$job->salary}}</option>
                @endif
                @endforeach
            </select>
        </div>

        <div class="col2-4">
            <label for="email">Email </label>
            <input type="email"  name="email" id="email" value="{{$worker->email}}">
            <label for="phone">Телефон </label>
            <input type="text"  placeholder="8(000)000-00-00" name="phone" id="phone" value="{{$worker->phone}}" required>
        </div>


        <div class="col1-4">
            <h3 class="col1-5">Навыки сотрудника</h3>
            <select id="skill" name="skillSelect" class="col1-3">
                @foreach ($skills as $skill)
                <option value="{{$skill->id}}" >{{$skill->name}}</option>
                @endforeach
            </select>
            <button type="button" class="addSkill col2-3">Добавить</button>
            <table class="col1-2">
                <tbody class="skills">
                    <tr><th>Название</th></tr>

                    @foreach ($worker->skills as $skill)
                        <tr>
                            <td id='skill{{$skill->id}}'> {{$skill->name}}
                                </td> 
                            <td class='hide'>
                                 <input type='text' name='skill[]' value='{{$skill->id}}' readonly/>
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
