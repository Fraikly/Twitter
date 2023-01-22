@extends('layouts.header')
@section('content')
    <div class="users">
        <div class="twit">
            <div class="twit_info">
                <img src="{{asset('/storage/' .$user->picture)}}" class="twit_profile_photo"
                     alt="missing image">
                <label class="twit_header"> <label class="twit_name">{{$user->login}}
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
                    </label>
                </label>
            </div>
            <div class="twit_content">
                <form action="{{route('twits.update',$twit->id)}}" method="post" id="newTwitForm"
                      onsubmit=" return CheckPhotos();" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <p><textarea maxlength="400" name="text" required class="twit_text">{{$twit->text}}</textarea></p>


                    @if($twit->images()->count()>0)
                        <div id="old_photo">
                            @foreach($twit->images()->get() as $image)
                                <img src="{{asset('/storage/'.$image->patch)}}" width="100px" alt="missing image">
                            @endforeach
                        </div>
                    @endif

                    @if($twit->retwit===1)
                        <div class="twit" style="    border: 3px solid #9f9d9d4a;
    padding: 20px;
    width: 90%;    margin-top: 20px;">
                            <a style="cursor: pointer"
                               href="{{route('users.show',\App\Models\User::find(\App\Models\Twit::find($twit->original_twit)->user_id)->id)}}">
                                <img
                                    src="{{asset('/storage/' .\App\Models\User::find(\App\Models\Twit::find($twit->original_twit)->user_id)->picture)}}"
                                    class="twit_profile_photo"
                                    alt="missing image">
                                <div class="twit_info" style="display: contents">

                                    <label class="twit_header"> <label
                                            class="twit_name">{{\App\Models\User::find(\App\Models\Twit::find($twit->original_twit)->user_id)->login}}
                                        </label>
                                        <label class="twit_date">
                                            @if((date('Y-m-d')===date('Y-m-d',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))))
                                                сегодня
                                                в {{date('H:i',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))}}

                                            @elseif(date('Y-m-d',strtotime("-1 days"))===date('Y-m-d',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at)))
                                                вчера
                                                в {{date('H:i',strtotime(\App\Models\Twit::find($twit->original_twit)->created_at))}}

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

                                    <p><input type="image" src="{{URL::to('/')}}\img\for_interface\no_like_twit.png"
                                              style="width: 28px"
                                              alt="Submit" class="likes_button">


                                @else

                                    <p><input type="image" src="{{URL::to('/')}}\img\for_interface\like_twit.png"
                                              style="width: 28px"
                                              alt="Submit" class="likes_button">

                                        @endif

                                        <label
                                            class="likes_count"> {{\App\Models\Twit::find($twit->original_twit)->likes()->count()}}</label>

                                        <input type="image" src="{{URL::to('/')}}\img\for_interface\comments.png"
                                               style="width: 28px" alt="Submit"
                                               class="likes_button">
                                        <label
                                            class="likes_count">   {{\App\Models\Twit::find($twit->original_twit)->comments()->count()}}</label>


                                        <input type="image" src="{{URL::to('/')}}\img\for_interface\retwit.png"
                                               style="width: 28px" alt="Submit"
                                               class="likes_button">
                                        <label
                                            class="likes_count"> {{\App\Models\Twit::where('original_twit',\App\Models\Twit::find($twit->original_twit)->id)->count()}}</label>
                            </div>
                            <div id="show" class="centered_div">
                                <center>
                                    <p id="show_pic"></p>
                                </center>
                            </div>
                        </div>
            </div>
            @endif
            <div class="likes">


                @if( !\Illuminate\Support\Facades\Auth::check() or \App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->likesForTwit()->where('twit_id',$twit->id)->get()->isEmpty())
                    <p><img src="{{URL::to('/')}}\img\for_interface\no_like_twit.png"
                            style="width: 28px" class="likes_button">
                @else
                    <p><img src="{{URL::to('/')}}\img\for_interface\like_twit.png"
                            style="width: 28px" class="likes_button">
                        @endif

                        <label class="likes_count"> {{$twit->likes()->count()}}</label>
                        <img src="{{URL::to('/')}}\img\for_interface\comments.png"
                             style="width: 28px"
                             class="likes_button">
                        <label class="likes_count">{{$twit->comments()->count()}}</label></label>

                        <img src="{{URL::to('/')}}\img\for_interface\retwit.png"
                             style="width: 28px"
                             class="likes_button">
                        <label
                            class="likes_count"> {{\App\Models\Twit::where('original_twit',$twit->id)->count()}}</label>

            </div>


        </div>

    </div>
    <div class="other">
        <p class="checkbox_title"><input type="checkbox" id="checkbox" onclick="visiblePhotos(); " name="old_photo"
                                         value="1" checked>Оставить старые фото
            <label for="photos" class="custom-file-upload" id="photos_title" style="    display: none;
    width: 245px;
    margin-bottom: 6%;">
                выбрать фото
            </label></p>
        <input id="photos" accept="image/*" multiple name="photos[]" type="file"/>
        <button type="submit" id="button">Обновить</button>

        </form>

        <form action="javascript:history.back()"
              onclick="return confirm('Вы уверены, что хотите выйти? Данные не будут сохранены')">
            <button type="submit">Назад</button>
        </form>
    </div>
    </div>
    </div>


    <script>
        document.getElementById('photos').style.display = 'none';

        function CheckPhotos() {
            var photos = document.getElementById('photos');
            if (photos.files.length > 3) {
                alert("Кол-во фотографий не должно превышать 3-х");
                return false;
            } else
                return true;

        }

        function visiblePhotos() {
            var checkbox = document.getElementById('checkbox');
            if (checkbox.checked) {
                document.getElementById('photos_title').style.display = 'none';
                document.getElementById('old_photo').style.display = 'block';
            } else {
                document.getElementById('photos_title').style.display = 'block';
                document.getElementById('old_photo').style.display = 'none';
            }
        }
    </script>

@endsection
