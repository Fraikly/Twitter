@extends('layouts.header')

@section('content')
<div class="users" style="align-items: inherit">
<div class="comment">
    <div style="margin: 0;margin-bottom: 15px;">

        <a href="{{route('users.show',$comment->user_id)}}">  <img src="{{asset('/storage/' .\App\Models\User::find($comment->user_id)->picture)}}"
                                                                   class="comment_profile_photo">
            <label class="comments_name">{{\App\Models\User::find($comment->user_id)->login}}
                <label class="twit_date">
                    @if((date('Y-m-d')===date('Y-m-d',strtotime($comment->created_at))))
                        сегодня в {{date('H:i',strtotime($comment->created_at))}}

                    @elseif(date('Y-m-d',strtotime("-1 days"))===date('Y-m-d',strtotime($comment->created_at)))
                        вчера в {{date('H:i',strtotime($comment->created_at))}}

                    @elseif(date('Y')===date('Y',strtotime($comment->created_at)))
                        {{date("H:i - d {$months[date('M',strtotime($comment->created_at))]} ",strtotime($comment->created_at))}}
                    @else
                        {{date("H:i - d {$months[date('M',strtotime($comment->created_at))]} Y",strtotime($comment->created_at))}}
                    @endif

                        (ред.)

                </label>
            </label>
        </a>

<form action="{{route('comments.update',[$twit->id,$comment->id])}}" method="post">
    @csrf
    @method('patch')
{{--        <label class="comment_text">{{$comment->text}}</label>--}}
        <textarea maxlength="200" name="text" required class="comment_text" style="background: none; border: none">{{$comment->text}}</textarea>


        <div class="likes" style="position: absolute;
    right: 32%;">
            <img  src="{{URL::to('/')}}\img\for_interface\no_like_twit.png" style="width: 24px"  class="likes_button">
            <img  src="{{URL::to('/')}}\img\for_interface\answer.png" style="width: 24px"  class="likes_button">

        </div>
    </div>

    <div style="    display: flex;
    margin-left: 20%;
    margin-top: 45px;
    width: 37%;">
        <button type="submit" id="button" style="width: 52%;">Обновить</button>

        </form>

        <form action="javascript:history.back()"
              onclick="return confirm('Вы уверены, что хотите выйти? Данные не будут сохранены')">
            <button type="submit" style="width: 140%;">Назад</button>
        </form>
    </div>
    @error('text')
    <center><strong>{{$message}}</strong></center>
    @enderror

</div>
</div>
@endsection
