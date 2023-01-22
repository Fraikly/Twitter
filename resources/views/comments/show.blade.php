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
        <form method="post" action="{{route('comment.likes.store',[$twit->id, $comment->id])}}" style="display: inline-block;    margin-bottom: 0;" id="create_likes">
            @csrf
            <input type="image" src="{{URL::to('/')}}\img\for_interface\no_like_twit.png" style="width: 24px" alt="Submit" class="likes_button">
        </form>


    @else
        <form method="post" action="{{route('comment.likes.delete',[$twit->id, $comment->id])}}" style="display: inline-block;    margin-bottom: 0;" id="delete_likes">
            @csrf
            @method('delete')
            <input type="image" src="{{URL::to('/')}}\img\for_interface\like_twit.png" style="width: 24px" alt="Submit" class="likes_button">
        </form>
    @endif

        <label class="likes_count"> {{$comment->likes()->count()}}</label>
        <form method="get" action="{{route('recomments.create',[$twit->id, $comment->id])}}" style="display: inline-block;    margin-bottom: 0;" id="delete_likes">
            @csrf
        <input type="image" src="{{URL::to('/')}}\img\for_interface\answer.png" style="width: 24px" alt="Submit" class="likes_button">
        </form>
    </div>
    </div>

    @foreach(\App\Models\Comment::where(['comment_id'=>$comment->id])->get() as $reComment)
        @include('comments.recomments.show')
    @endforeach
</div>

