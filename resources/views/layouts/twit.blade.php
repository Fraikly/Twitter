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
        </label>
        </div>
<div class="twit_content">
        <p>{{$twit->text}}</p>
        @if($twit->photos!='')
            @if(str_contains($twit->photos,"; "))
                @foreach(explode('; ',$twit->photos) as $photo)
                    <img src="{{URL::to('/')}}\img\{{$photo}}" width="100px" alt="missing image">
                @endforeach
            @else
                <img src="{{URL::to('/')}}\img\{{$twit->photos}}" width="100px" alt="missing image">
            @endif
        @endif
     <p>   <a href=""> <img src="{{URL::to('/')}}\img\for_interface\like_twit.png" width="28px"
                            alt="missing image"></a>

