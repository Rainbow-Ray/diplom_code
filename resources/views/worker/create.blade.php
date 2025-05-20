@extends('index')
@section('title')
    <title>Новый сотрудник</title>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/imask.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/phoneMask.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/skillAdd/skillAdd.js') }}" type="module"></script>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('main')
    <h2>Добавить данные сотрудника</h2>
    <form action="/{{ $rootURL }}" method="POST">
        @csrf
        <div class="labelTop start1 end3">
            <label for="surname">Фамилия</label>
            <input type="text" name="surname" id="surname" required>
        </div>
        <div class="labelTop start3">
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="labelTop start4 end6">
            <label for="patronym">Отчество</label>
            <input type="text" name="patronym" id="patronym">
        </div>


        <div class="start6 end7">
            <label for="dateBirth">Дата рождения </label>
            <input type="date" name="dateBirth" id="dateBirth" required>
        </div>


        <div class="labelTop start1">
            <label for="passSerie">Серия паспорта </label>
            <input type="text" placeholder="1234" name="passSerie" id="passSerie">


        </div>
        <div class="labelTop start2 end4">
            <label for="passNum">Номер паспорта </label>
            <input type="text" placeholder="123456" name="passNum" id="passNum">
        </div>
        <div class="labelTop start4 end6">
            <label for="datePass">Дата выпуска паспорта </label>
            <input type="date" name="datePass" id="datePass">
        </div>

        <div class="labelTop start1 end4">
            <label for="addrPass">Адрес прописки </label>
            <input type="text" name="addrPass" id="addrPass">
        </div>
        <div class="labelTop start4 end7">
            <label for="addrFact">Адрес факт. проживания </label>
            <input type="text" name="addrFact" id="addrFact">
        </div>

        <div class="labelTop start1 end4">
            <label for="job">Должность</label>
            <select id="job" name="job">
                @foreach ($jobs as $job)
                    <option value="{{ $job->id }}">{{ $job->name . '| ' . $job->salary }}</option>
                @endforeach
            </select>
        </div>

        <div class="labelTop">
            <label for="email">Email </label>
            <input type="email" name="email" id="email">
        </div>
        <div class="labelTop">
            <label for="phone">Телефон </label>
            <input type="text" placeholder="8(000)000-00-00" name="phone" id="phone" required>
        </div>


        <div class="start1 end4 hide">
            <h3 class="col1-5">Услуги, которые может оказывать сотрудник</h3>
            <select id="skill" name="skillSelect" class="col1-3">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
            <button type="button" class="addSkill col2-3 beautyButton">Добавить</button>
            <table class="col1-2">
                <tbody class="skills">
                    <tr>
                        <th>Название</th>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="beautyButton" class="deleteSkill col2-3">Удалить</button>

        </div>
        {{-- <div class="col1-4">
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
                </tbody>
            </table>
            <button type="button" class="deleteSkill col2-3">Удалить</button>

        </div> --}}


        <input type="submit" class="beautyButton submitButton rstart7 end7"  value="Отправить">
    </form>
@endsection
