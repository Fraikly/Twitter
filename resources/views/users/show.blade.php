@extends('layouts.header')
@section('content')
    <div class="users">
        <div class="profile_cards">
            <img src="{{asset('/storage/' .$user->picture)}}" alt="missing image" class="profile_photo">
            <div class="profile_info">
                <p class="profile_name">{{$user->login}}</p>
                <p class="profile_about">{{$user->about}}</p>

                <p class="counts">Твиты: {{$twitsCount}}</p>
                <p class="counts"><a href="{{route('subscribers.index',$user->id)}}">Подписчики:</a> {{$subscribers}}
                </p>
                <p class="counts"><a href="{{route('subscriptions.index',$user->id)}}">Подписки:</a> {{$subscriptions}}
                </p>
                <div class="profile_buttons">
                    @can('view',$user)

                        <form action="{{route('users.edit',$user->id)}}">
                            <button type="submit"> Редактировать</button>
                        </form>
                        <form action="{{route('twits.create')}}">
                            <button type="submit">Создать новый твит</button>
                        </form>
                    @endcan

                    @auth()
                        @cannot('view',$user)
                            @can('create',$user)
                                <form action="{{route('subscribers.store',$user->id)}}" method="post">
                                    @csrf
                                    <button type="submit">подписаться</button>
                                </form>
                            @endcan

                            @cannot('create',$user)
                                <form action="{{route('subscribers.delete',$user->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">отписаться</button>
                                </form>
                            @endcannot
                        @endcannot
                    @endauth
                </div>
            </div>
        </div>
        <div class="twits">
            @if($twitsCount===0)
                <p class="welcome_quot">Пользователь ещё ничего не опубликовал</p>
            @endif
            @foreach($twits as $twit)
                @if($twit->retwit!=1)
                <div class="twit">
                    <img src="{{asset('/storage/' .$user->picture)}}" class="twit_profile_photo"
                         alt="missing image">
                    <div class="twit_info" style="display: contents">

                        <label class="twit_header"> <label class="twit_name">{{$user->login}}
                                @auth()
                                    @if($twit->user_id===\Illuminate\Support\Facades\Auth::user()->id)
                                        <div class="edit_twit_icons">
                                            <a href="{{route('twits.edit',$twit->id)}}"> <img
                                                    src="{{URL::to('/')}}\img\for_interface\edit_twit.png"
                                                    width="28px" alt="missing image"></a>
                                            </p>
                                            <form method="post"
                                                  onclick="return confirm('Вы хотите удалить этот твит?')"
                                                  style="position: relative"
                                                  action="{{route('twits.delete',$twit->id)}}">
                                                @csrf
                                                @method('delete')
                                                <input type="image" src="\img\for_interface\delete_twit.png" alt="Submit"
                                                       style="width: 28px; box-shadow: none;background: none" class="">

                                            </form>
                                        </div>
                                    @endif
                                @endauth</label>
                            @include('layouts.twit')

                    </div>
                </div>
                    @else
                    @include('layouts.retwit')
                    @endif
                @include('comments.create')
            @endforeach
            <center>
                <p>{{$twits->withQueryString()->links()}}</p>
            </center>
            @endsection
        </div>
    </div>
