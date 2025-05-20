@extends('index')
@section('title')
    <title>Редактировать данные пользователя</title>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/select2.min.js') }}"></script>
    <script src=" {{ asset('assets/js/user/user.js') }}" type="module"></script>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />

    <script>
        $(document).ready(function(){


        });
    </script>
@endsection
@section('main')
    <form action="/{{ $rootURL }}/{{ $user->id }}" method="POST">
        @csrf
        @method('PUT')

        <h2>Редактировать данные пользователя</h2>

        <div class="labelTop start1">
            <span>Имя:</span>
            <span>{{ $user->name }}</span>
        </div>

        <div class="labelTop">
            <span>Email:</span>
            <span>{{ $user->email }}</span>
        </div>


        <div class="labelTop start3 end7">
            <label for="worker">Сотрудник:</label>
            <select id="worker" name="worker" class="col1-3">
                <option value=""></option>
                @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}" @if($user->worker->id == $worker->id) selected @endif>
                        {{$worker->surname}}
                        {{$worker->name}}
                        {{$worker->patronym}} //
                        {{$worker->job->name}}
                    </option>
                @endforeach
            </select>
        </div>
        

        <div class="start1 end4 receiptData">
            <h3 class="start1 end5">Роли</h3>
            <select id="role" name="roleSelect" class="start1 end5">
                <option value=""></option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <button type="button" class="addRole beautyButton col2-3">Добавить</button>

            <table class="col1-2">
                <tbody class="roles">
                    <tr>
                        <th>Название</th>
                    </tr>

                    @foreach ($user->getRoles as $role)
                        <tr>
                            <td id='role{{ $role->id }}'>
                                {{ $role->name }}
                            </td>
                            <td class='hide'>
                                <input type='text' name='role[]' value='{{ $role->id }}' readonly />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="text" class="hide" readonly name="roleEdit" value="1">
            <button type="button" class="deleteRole beautyButton col2-3">Удалить</button>

        </div>


        <input type="submit" class="beautyButton submitButton end7 rstart5" value="Отправить">
    </form>
@endsection
