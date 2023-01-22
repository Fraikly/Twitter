<div class="twit">
    <div class="twit_info">
        <a href="{{route('users.show',$twit->user_id)}}">
        @if($title!='Главная')
            <img src="{{asset('/storage/' .$user->picture)}}"
            class="twit_profile_photo"
            alt="missing image">
        @else
            <img src="{{asset('/storage/' .\App\Models\User::find($twit->user_id)->picture)}}"
                 class="twit_profile_photo"
                 alt="missing image">
            @endif
        <label class="twit_header"> <label
                class="twit_name" style="cursor: pointer">
                @if($title!='Главная')
                    {{$user->login}}
                @else
                    {{\App\Models\User::find($twit->user_id)->login}}
                @endif

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
                @endauth
            </label>
            <label class="twit_date">
                @if((date('Y-m-d')===date('Y-m-d',strtotime($twit->created_at))))
                    сегодня в {{date('H:i',strtotime($twit->created_at))}}

                @elseif(date('Y-m-d',strtotime("-1 days"))===date('Y-m-d',strtotime($twit->created_at)))
                    вчера в {{date('H:i',strtotime($twit->created_at))}}

                @elseif(date('Y')===date('Y',strtotime($twit->created_at)))
                    {{date("H:i - d {$months[date('M',strtotime($twit->created_at))]} ",strtotime($twit->created_at))}}
                @else
                    {{date("H:i - d {$months[date('M',strtotime($twit->created_at))]} Y",strtotime($twit->created_at))}}
                @endif
                @if($twit->created_at!=$twit->updated_at)
                    (ред.)
                @endif

            </label> </a>
        </label>
    </div>
    <div class="twit_content">
        <p>в ответ <a href="{{route('users.show',\App\Models\User::find(\App\Models\Twit::find($twit->original_twit)->user_id)->id)}}"
            style="color: #0052CC">
                {{\App\Models\User::find(\App\Models\Twit::find($twit->original_twit)->user_id)->login}},
            </a>{{$twit->text}}</p>
        @if($twit->images()->count()>0)
            @foreach($twit->images()->get() as $key => $image)
                <img src="{{asset('/storage/'.$image->patch)}}" width="200px" alt="missing image" id="{{$twit->id . $key}}"
                     onclick="show(id);">
            @endforeach
        @endif



    <div class="twit" style="    border: 3px solid #9f9d9d4a;
    padding: 20px;
    width: 90%;    margin-top: 20px;">
       <a  style="cursor: pointer" href="{{route('users.show',\App\Models\User::find(\App\Models\Twit::find($twit->original_twit)->user_id)->id)}}">
           <img src="{{asset('/storage/' .\App\Models\User::find(\App\Models\Twit::find($twit->original_twit)->user_id)->picture)}}" class="twit_profile_photo"
             alt="missing image">
        <div class="twit_info" style="display: contents">

            <label class="twit_header"> <label class="twit_name">{{\App\Models\User::find(\App\Models\Twit::find($twit->original_twit)->user_id)->login}}
                </label>
                <label class="twit_date">
                    @if((date('Y-m-d')===date('Y-m-d',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))))
                        сегодня в {{date('H:i',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))}}

                    @elseif(date('Y-m-d',strtotime("-1 days"))===date('Y-m-d',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at)))
                        вчера в {{date('H:i',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))}}

                    @elseif(date('Y')===date('Y',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at)))
                        {{date("H:i - d {$months[date('M',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))]} ",strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))}}
                    @else
                        {{date("H:i - d {$months[date('M',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))]} Y",strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))}}
                    @endif
                    @if(\App\Models\Twit::find($twit->original_twit)->created_at!=\App\Models\Twit::find($twit->original_twit)->updated_at)
                        (ред.)
                    @endif

                </label>
                </a>
            </label>
        </div>
        <div class="twit_content">
            <p>{{\App\Models\Twit::find($twit->original_twit)->text}}</p>

            @if(\App\Models\Twit::find($twit->original_twit)->images()->count()>0)
                @foreach(\App\Models\Twit::find($twit->original_twit)->images()->get() as $key => $image)
                    <img src="{{asset('/storage/'.$image->patch)}}" width="100px" alt="missing image"
                         id="{{\App\Models\Twit::find($twit->original_twit)->id . $key}}"
                         onclick="show(id);">
                @endforeach
            @endif
            <div class="likes">


                @if( !\Illuminate\Support\Facades\Auth::check() or \App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->likesForTwit()->where('twit_id',\App\Models\Twit::find($twit->original_twit)->id)->get()->isEmpty())
                    <form method="post" action="{{route('likes.store',\App\Models\Twit::find($twit->original_twit)->id)}}"
                          style="display: inline-block;    margin-bottom: 0;" id="create_likes">
                        @csrf
                        <p><input type="image" src="{{URL::to('/')}}\img\for_interface\no_like_twit.png" style="width: 28px"
                                  alt="Submit" class="likes_button">
                    </form>

                @else
                    <form method="post" action="{{route('likes.delete',\App\Models\Twit::find($twit->original_twit)->id)}}"
                          style="display: inline-block;    margin-bottom: 0;" id="delete_likes">
                        @csrf
                        @method('delete')
                        <p><input type="image" src="{{URL::to('/')}}\img\for_interface\like_twit.png" style="width: 28px"
                                  alt="Submit" class="likes_button">
                    </form>
                @endif

                <label class="likes_count"> {{\App\Models\Twit::find($twit->original_twit)->likes()->count()}}</label>
                <a href="{{route('comments.index',\App\Models\Twit::find($twit->original_twit)->id)}}">
                    <input type="image" src="{{URL::to('/')}}\img\for_interface\comments.png" style="width: 28px" alt="Submit"
                           class="likes_button">
                    <label class="likes_count">   {{\App\Models\Twit::find($twit->original_twit)->comments()->count()}}</label></a>

                <a href="{{route('retwits.create',\App\Models\Twit::find($twit->original_twit)->id)}}">
                    <input type="image" src="{{URL::to('/')}}\img\for_interface\retwit.png" style="width: 28px" alt="Submit"
                           class="likes_button">
                    <label class="likes_count"> {{\App\Models\Twit::where('original_twit',\App\Models\Twit::find($twit->original_twit)->id)->count()}}</label></a>
            </div>
            <div id="show" class="centered_div">
                <center>
                    <p id="show_pic"></p>
                </center>
            </div>
        </div>
    </div>


    <div class="likes">
        @if( !\Illuminate\Support\Facades\Auth::check() or \App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->likesForTwit()->where('twit_id',$twit->id)->get()->isEmpty())

        <form method="post" action="{{route('likes.store',$twit->id)}}"
              style="display: inline-block;    margin-bottom: 0;" id="create_likes">
            @csrf
            <p><input type="image" src="{{URL::to('/')}}\img\for_interface\no_like_twit.png" style="width: 28px"
                      alt="Submit" class="likes_button">
        </form>

        @else
            <form method="post" action="{{route('likes.delete',$twit->id)}}"
                  style="display: inline-block;    margin-bottom: 0;" id="delete_likes">
                @csrf
                @method('delete')
                <p><input type="image" src="{{URL::to('/')}}\img\for_interface\like_twit.png" style="width: 28px"
                          alt="Submit" class="likes_button">
            </form>
        @endif

        <label class="likes_count"> {{$twit->likes()->count()}}</label>
        <a href="{{route('comments.index',$twit->id)}}">
            <input type="image" src="{{URL::to('/')}}\img\for_interface\comments.png" style="width: 28px" alt="Submit"
                   class="likes_button">
            <label class="likes_count">   {{$twit->comments()->count()}}</label></a>

        <a href="{{route('retwits.create',$twit->id)}}">
            <input type="image" src="{{URL::to('/')}}\img\for_interface\retwit.png" style="width: 28px" alt="Submit"
                   class="likes_button">
            <label class="likes_count"> {{\App\Models\Twit::where('original_twit',$twit->id)->count()}}</label></a>

    </div>


</div>
</div>
