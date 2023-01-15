@extends('layouts.head')
@section('body')
    <body>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="main_section">
            <div class="headers">
                <p class="main_header">ЗАРЕГИСТРИРУЙТЕСЬ</p>
                <p class="additional_header">ЧТОБЫ НАЧАТЬ ПОЛЬЗОВАТЬСЯ СИСТЕМОЙ</p>

            </div>
            <div class="content">
                <div class="main_part">
                    <div class="content_part">

                        <label class="part_header">РЕГИСТРАЦИЯ АККАУНТА</label>

                        <input id="login" type="text" name="login" value="{{ old('login') }}" required
                               autocomplete="name"
                               autofocus placeholder="Введите логин">

                        @error('login')
                        <strong>{{ $message }}</strong>
                        @enderror


                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               autocomplete="email"
                               placeholder="Введите почту">

                        @error('email')
                        <strong>{{ $message }}</strong>
                        @enderror


                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               placeholder="Придумайте пароль">

                        @error('password')
                        <strong>{{ $message }}</strong>
                        @enderror


                        <input id="password-confirm" type="password" name="password_confirmation" required
                               autocomplete="new-password" placeholder="Повторите пароль">
                        <p class="additional_content">Регистрируясь, я соглашаюсь с Условиями использования продуктов и
                            принимаю Политику конфиденциальности</p>

                        <button type="submit">
                            Зарегистрироваться
                        </button>
                        <a class="additional_header" href="{{ route('login')}}">У вас уже есть аккаунт?</a>
                    </div>
                </div>
            </div>
        </div>


    </form>
    </body>

@endsection
