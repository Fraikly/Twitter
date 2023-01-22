@extends('layouts.head')
@section('body')
    <body>
    <header>
        <div class="navigation">
            <a href="{{ url('/') }}" class="home">TWITTER</a>

            <a href="{{ route('users.index') }}">Пользователи</a>


            @guest
                <label class="authorization_navigation">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">Вход</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Регистрация</a>
                    @endif
                </label>
            @else

                <label class="profile_navigation">
                    <a href="{{route('users.show', Auth::user()->id)}}">
                        {{ Auth::user()->login }}
                    </a>
                    <div class="dropdown">
                        v
                        <div class="dropdown-content">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Выйти
                            </a>

                        </div>
                    </div>
                </label>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
    </header>
    <main style="margin-top: 7%">
        @yield('content')
    </main>

    </body>
    </html>
@endsection
