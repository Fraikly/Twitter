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

</label>
</a>
</label>
</div>
<div class="twit_content">
    <p>{{$twit->text}}</p>

    @if($twit->images()->count()>0)
        @foreach($twit->images()->get() as $key => $image)
            <img src="{{asset('/storage/'.$image->patch)}}" width="200px" alt="missing image" id="{{$twit->id . $key}}"
                 onclick="show(id);">
        @endforeach
    @endif

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
    <div id="show" class="centered_div">
        <center>
            <p id="show_pic"></p>
        </center>
    </div>
    <script>
        function show(id) {
            let elem = document.createElement("img");
            let src = document.getElementById(id).src;

            elem.setAttribute("src", src);
            elem.setAttribute("width", "400px");

            document.getElementById("show_pic").appendChild(elem);
            document.getElementById("show").style.display = 'flex';


        }

        document.onclick = function (e) {
            if (document.getElementById("show").style.display === 'flex') {
                if (e.target === document.getElementById('show')) {
                    document.getElementById("show").style.display = 'none';
                    document.getElementById('show_pic').innerHTML = "";

                }
            }

        }
    </script>
