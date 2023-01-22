@extends('layouts.header')
@section('content')
    <div class="users">
        <div class="search_options">
            <label class="option_caption">Поиск пользователей</label>
            <div>
                <form method="get" onsubmit="{{route('users.index','login')}}" style="position: relative">
                    <input type="text" name="login" class="search">
                    <input type="image" src="img/for_interface/search.png" class="search_button" alt="Submit">
                </form>

            </div>
        </div>
        <div class="profiles">
            @if(count($users)===0)
                <p class="nothing_find">Пользователи не найдены</p>
            @else

                @foreach($users as $user)
                    <div class="profiles_info">
                        <a href="{{route('users.show', $user->id)}}"
                         > <img src="{{asset('/storage/' .$user->picture)}}" class="profiles_photo">
                        <p  class="profiles_name">{{ $user->login }} </a></p>
                        <label class="subscribers_info">Подписчики: {{$user->subscribers()->count()}}
                        @cannot('view',$user)
                            @if($subscriptions!=null)
                        @if($subscriptions->find($user->id)===null)
                            <form method="post"
                                  onclick="return confirm('Вы хотите подписаться на {{$user->login}}?')"
                                  style="position: relative"
                                  action="{{route('subscribers.store',$user->id)}}"
                            >
                                @csrf
                                <input type="image" src="img/for_interface/no_subscriber.png" class="subscribe_icon"
                                       alt="Click">
                            </form>
                        @else

                            <form method="post"
                                  onclick="return confirm('Вы хотите отписаться от {{$user->login}}?')"
                                  style="position: relative"
                                  action="{{route('subscribers.delete',$user->id)}}">
                                @csrf
                                @method('delete')
                                <input type="image"  src="img/for_interface/subscriber.png" class="subscribe_icon"  alt="Submit">
                            </form>

                            @endif
                            @endif
                            @endcannot
                            </label>
                    </div>

                @endforeach
                <p>{{$users->withQueryString()->links()}}</p>
            @endif
        </div>
    </div>

@endsection
