@extends('List')

@section('title')
    <title>Сотрудник {{ $worker->surname }} {{ $worker->name }} {{ $worker->patronym }}</title>

    <script src=" {{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('header')
    {{ $worker->surname }}
    {{ $worker->name }}
    {{ $worker->patronym }}
@endsection
@section('addButton')
@endsection


@section('dictCard')
    <div class="receiptForm col3">
        <div class="labelTop">
            <span class="cardLabel">ФИО:</span>
            <span class="cardData">{{ $worker->surname }} {{ $worker->name }} {{ $worker->patronym }}</span>
        </div>

        <div class="labelTop">
            <span class="cardLabel">Должность:</span>
            <span class="cardData">{{ $worker->job->name }}</span>

        </div>


        <div class="labelTop">
            <span class="cardLabel">Дата рождения:</span>
            <span class="cardData">{{ $worker->dateBirth }}</span>

        </div>

        <div class="col1-4 col3">
            <div class="labelTop">
                <span class="cardLabel">Серия паспорта:</span>
                <span class="cardData">{{ $worker->passSerie }}</span>

            </div>
            <div class="labelTop">
                <span class="cardLabel">Номер паспорта:</span>
                <span class="cardData">{{ $worker->passNum }}</span>
            </div>
            <div class="labelTop">
                <span class="cardLabel">Дата выпуска паспорта:</span>
                <span class="cardData">{{ $worker->datePass }}</span>

            </div>
        </div>

        <div class="col1-4">
            <div class="labelTop">
                <span class="cardLabel">Адрес прописки:</span>
                <span class="cardData">{{ $worker->addrPass }}</span>

            </div>
            <div class="labelTop">
                <span class="cardLabel">Адрес факт. проживания:</span>
                <span class="cardData">{{ $worker->addrFact }}</span>
            </div>
        </div>

        <div class="labelTop">
            <span class="cardLabel">Email:</span>
            <span class="cardData">{{ $worker->email }}</span>

        </div>
        <div class="labelTop">
            <span class="cardLabel">Телефон:</span>
            <span class="cardData">{{ $worker->phone }}</span>

        </div>
    </div>

    <div class="col1-4 hide receiptData">
        <h3 class="col1-5">Услуги сотрудника</h3>
        <table class="col1-2">
            <tbody class="skills">
                <tr>
                    <th>Название</th>
                </tr>

                @foreach ($worker->services as $skill)
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

    </div>

                <a href="{{ url('worker/' . strval($worker->id) . '/edit', []) }}">
                <button class="beautyButton addButton  right">Редактировать</button>
            </a>


    {{-- <div class="col1-4 receiptData">
        <h3 class="col1-5">Навыки сотрудника</h3>
        <table class="col1-2">
            <tbody class="skills">
                <tr>
                    <th>Название</th>
                </tr>

                @foreach ($worker->skills as $skill)
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

    </div> --}}
@endsection
