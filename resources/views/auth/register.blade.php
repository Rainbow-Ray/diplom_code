{{-- <x-guest-layout> --}}
    @extends('index')

    @section('title')
    <title>Регистрация</title>

@endsection

    @section('main')

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Регистрация</h2>

        <!-- Name -->
        <div class="start1">
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input id="name" class=" mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class=" mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 start1">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" class=" mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 start2">
            <x-input-label for="password_confirmation" :value="__('Повторите пароль')" />

            <x-text-input id="password_confirmation" class=" mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="start1 end3 items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Уже регистрировались?') }}
            </a>

        </div>
        <div class="end3">
                    <x-primary-button class="ms-4 beautyButton submitButton right rstart7 ">
                {{ __('Регистрация') }}
            </x-primary-button>


        </div>

    </form>

        @endsection

{{-- </x-guest-layout> --}}
