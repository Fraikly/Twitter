@extends('layouts.header')

@section('content')
    <div class="users">
        <div class="twits welcome_twits">
            <div class="comment">
                <div style="margin: 0;margin-bottom: 15px;">
                    @if(\Illuminate\Support\Facades\Auth::user()->id===$comment->user_id)
                        <div class="comment_edit">
                            <a href="{{route('comments.edit',[$twit->id, $comment->id])}}"> <img
                                    src="{{URL::to('/')}}\img\for_interface\edit_twit.png"
                                    width="24px" alt="missing image"></a>
                            <form method="post" action="{{route('comments.delete',[$twit->id, $comment->id])}}" onclick="return confirm('Вы уверены, что хотите удалить комментарий?');">
                                @csrf
                                @method('delete')
                                <input type="image" src="\img\for_interface\delete_twit.png" alt="Submit"
                                       style="width: 24px; box-shadow: none; background: none" class="">
                            </form>
                        </div>
                    @endif
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
                                @if($comment->created_at!=$comment->updated_at)
                                    (ред.)
                                @endif
                            </label>
                        </label>
                    </a>


                    <label class="comment_text">{{$comment->text}}</label>



                    <div class="likes" style="position: absolute;
    right: 32%;">

                        @if( !\Illuminate\Support\Facades\Auth::check() or \App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->likesForComment()->where('comment_id',$comment->id)->get()->isEmpty())

                            <input type="image" src="{{URL::to('/')}}\img\for_interface\no_like_twit.png" style="width: 24px" alt="Submit" class="likes_button">



                        @else

                            <input type="image" src="{{URL::to('/')}}\img\for_interface\like_twit.png" style="width: 24px" alt="Submit" class="likes_button">

                        @endif

                        <label class="likes_count"> {{$comment->likes()->count()}}</label>

                        <input type="image" src="{{URL::to('/')}}\img\for_interface\answer.png" style="width: 24px" alt="Submit" class="likes_button">

                    </div>
                </div>
            </div>

            <div class="comments" style="border-bottom: 3px solid #9f9d9d4a;margin-bottom: 33px;margin-left: 8%;">
                <form method="post" action="{{route('recomments.store',[$twit->id,$comment->id])}}">

                    <p style="margin: 0;margin-bottom: 15px;">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <img src="{{asset('/storage/' .\App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->picture)}}"
                                 class="comment_profile_photo">
                            <label class="comments_name">{{\App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->login}}
                                @else
                                    <img src="{{asset('/storage/icons/user.png')}}"
                                         class="comment_profile_photo">
                                    <label class="comments_name">Неизвестный
                                        @endif
                                    </label>

                                    @csrf
                                    <input type="text" name="text" class="comments_text" placeholder="Добавить комментарий" required style="width: 51%;">
                                    <button type="submit" class="create_comments" name="is_answer" value="1">ок</button>
                                    @error('text')
                                    <center>  <strong>{{$message}}</strong></center>
                            @enderror
                    </p>
                </form>
            </div>
        </div>
        </div>
@endsection
