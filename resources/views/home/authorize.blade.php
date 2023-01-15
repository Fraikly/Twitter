@extends('layouts.header')

@section('content')
    <div class="users">

    @auth()
    @if($subscriptions->isEmpty())
        <p class="welcome_quot">Вы ни на кого не подписаны. Сделайте это <a href="{{route('users.index')}}" style="text-decoration:underline ">сейчас</a></p>

    @elseif($subscriptionsTwits->isEmpty())
        <p class="welcome_quot"> Никто из ваших подписок ничего еще не опубликовал</p>

    @else
        <p class="welcome_quot">Новости ваших подписок</p>

<div class="twits welcome_twits">
        @foreach($subscriptionsTwits as $twit)
                    <div class="twit">
                        <div class="twit_info">
             <a href="{{route('users.show',$twit->user_id)}}">  <img src="{{URL::to('/')}}\{{\App\Models\User::find($twit->user_id)->picture}}"class="twit_profile_photo" alt="missing image">
                 <label class="twit_header" style="cursor: pointer"><label class="twit_name" style="cursor: pointer">
                 {{\App\Models\User::find($twit->user_id)->login}}</label></a>
            @include('layouts.twit')
            </p>
                        </div>
                    </div>
                @endforeach
</div>
                <p>{{$subscriptionsTwits->withQueryString()->links()}}</p>
            @endif
            @endauth
    </div>
            @endsection
