@extends('layouts.head')
@section('body')

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="main_section">
            <div class="headers">
                <p class="main_header">ВОЙДИТЕ</p>
                <p class="additional_header">ЧТОБЫ ИСПОЛЬЗОВАТЬ СИСТЕМУ</p>

            </div>
            <div class="content">
                <div class="main_part">
                    <div class="content_part">
                        <label class="part_header">ВХОД В АККАУНТ</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               autocomplete="email" autofocus>
                        @error('email')

                                        <strong>{{ $message }}</strong>

                        @enderror


                        <input id="password" type="password" name="password"
                               required autocomplete="current-password">

                        @error('password')

                                        <strong>{{ $message }}</strong>

                        @enderror


                        <button type="submit" class="btn btn-primary">
                           ВОЙТИ
                        </button>
                        <a class="additional_header" href="{{ route('register')}}">У вас нет аккаунта?</a>
                        {{--                                                                    @if (Route::has('password.request'))--}}
                        {{--                                                                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                        {{--                                                                            {{ __('Forgot Your Password?') }}--}}
                        {{--                                                                        </a>--}}
                        {{--                                                                    @endif--}}


                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
