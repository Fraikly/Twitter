@extends('layouts.header')
@section('content')
    <div class="users">
        <div class="search_options">
            <label class="option_caption">Подписки {{$ownerUser->login}}</label>
            <div>
                <form method="get" onsubmit="{{route('subscribers.index','ownerUser','login')}}" style="position: relative">
                    <input type="text" name="login" class="search">
                    <input type="image" src="{{URL::to('/')}}/img/for_interface/search.png" class="search_button" alt="Submit">
                </form>

            </div>
        </div>
        <div class="profiles">
    @if(count($users)===0)
        <p class="nothing_find">Пользователи не найдены</p>

    @else

                    @foreach($users as $user)
                        <div class="profiles_info">
                        <img src="{{URL::to('/')}}\{{$user->picture}}" class="profiles_photo">
              <p>  <a href="{{route('users.show', $user->id)}}" class="profiles_name">{{ $user->login }} </a></p>
                            @auth()
            @if($ownerUser->id === \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier())
                <form method="post" action="{{route('subscribers.delete',$user->id)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="delete_subscriber" >Отписаться</button>
                </form>
                @endif
                            @endauth
                        </div>
    @endforeach
    <p>{{$users->withQueryString()->links()}}</p>
    @endif
    </div>
    </div>
@endsection
