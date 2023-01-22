<div class="comments" style="margin-bottom: 33px;margin-left: 8%;">
    <div style="margin: 0;margin-bottom: 15px;">
        @if(\Illuminate\Support\Facades\Auth::user()->id===$reComment->user_id)
            <div class="comment_edit">
                <a href="{{route('comments.edit',[$twit->id, $reComment->id])}}"> <img
                        src="{{URL::to('/')}}\img\for_interface\edit_twit.png"
                        width="24px" alt="missing image"></a>
                <form method="post" action="{{route('comments.delete',[$twit->id, $reComment->id])}}" onclick="return confirm('Вы уверены, что хотите удалить комментарий?');">
                    @csrf
                    @method('delete')
                    <input type="image" src="\img\for_interface\delete_twit.png" alt="Submit"
                           style="width: 24px; box-shadow: none; background: none" class="">
                </form>
            </div>
        @endif
        <a href="{{route('users.show',$reComment->user_id)}}">  <img src="{{asset('/storage/' .\App\Models\User::find($reComment->user_id)->picture)}}"
                                                                   class="comment_profile_photo">
            <label class="comments_name">{{\App\Models\User::find($reComment->user_id)->login}}
                <label class="twit_date">
                    @if((date('Y-m-d')===date('Y-m-d',strtotime($reComment->created_at))))
                        сегодня в {{date('H:i',strtotime($reComment->created_at))}}

                    @elseif(date('Y-m-d',strtotime("-1 days"))===date('Y-m-d',strtotime($reComment->created_at)))
                        вчера в {{date('H:i',strtotime($reComment->created_at))}}

                    @elseif(date('Y')===date('Y',strtotime($reComment->created_at)))
                        {{date("H:i - d {$months[date('M',strtotime($reComment->created_at))]} ",strtotime($reComment->created_at))}}
                    @else
                        {{date("H:i - d {$months[date('M',strtotime($reComment->created_at))]} Y",strtotime($reComment->created_at))}}
                    @endif
                    @if($reComment->created_at!=$reComment->updated_at)
                        (ред.)
                    @endif
                </label>
            </label>
        </a>


        <label class="comment_text">{{$reComment->text}}</label>



        <div class="likes" style="position: absolute;
    right: 32%;">

            @if( !\Illuminate\Support\Facades\Auth::check() or \App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->likesForComment()->where('comment_id',$reComment->id)->get()->isEmpty())
                <form method="post" action="{{route('comment.likes.store',[$twit->id, $reComment->id])}}" style="display: inline-block;    margin-bottom: 0;" id="create_likes">
                    @csrf
                    <input type="image" src="{{URL::to('/')}}\img\for_interface\no_like_twit.png" style="width: 24px" alt="Submit" class="likes_button">
                </form>


            @else
                <form method="post" action="{{route('comment.likes.delete',[$twit->id, $reComment->id])}}" style="display: inline-block;    margin-bottom: 0;" id="delete_likes">
                    @csrf
                    @method('delete')
                    <input type="image" src="{{URL::to('/')}}\img\for_interface\like_twit.png" style="width: 24px" alt="Submit" class="likes_button">
                </form>
            @endif

            <label class="likes_count"> {{$reComment->likes()->count()}}</label>

        </div>
    </div>
</div>
