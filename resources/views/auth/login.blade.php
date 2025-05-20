{{-- <x-guest-layout> --}}

@extends('index')
@section('title')
    <title>Вход</title>

@endsection

    @section('main')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Войти</h2>
        <!-- Email Address -->
        <div class="labelTop start1 end2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class=" mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 labelTop start2 ">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" class=" mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class=" mt-4 start1 end2">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Запомнить') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{-- {{ __('Forgot your password?') }} --}}
                </a>
            @endif

            <x-primary-button class="ms-3 end7 beautyButton submitButton right rstart7">
                {{-- {{ __('Log in') }} --}}Войти
            </x-primary-button>
        </div>
    </form>
            @endsection

{{-- </x-guest-layout> --}}
