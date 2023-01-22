@extends('layouts.header')
@section('content')
    <div class="users">
        <div class="twit">
            <div class="twit_info">
                <img
                    src="{{asset('/storage/' .\App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->picture)}}"
                    class="twit_profile_photo"
                    alt="missing image">
                <label class="twit_header"> <label
                        class="twit_name">{{\App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->login}}
                    </label>
                    <label class="twit_date">
                        сегодня в {{date('H:i',time())}}
                    </label>
                </label>
            </div>
            <div class="twit_content">
                <form action="{{route('retwits.store',$twit->id)}}" method="post" id="newTwitForm"
                      onsubmit=" return CheckPhotos();" enctype="multipart/form-data">
                    @csrf
                    <p><textarea maxlength="400" name="text" required class="twit_text"
                                 style="    border: 1px solid #595959c2;"></textarea></p>
                    <label for="photos" class="custom-file-upload">
                        выбрать фото
                    </label>
                    <input accept="image/*" name="photos[]" multiple id="photos" type="file"/>
            </div>
            <div class="twit" style="    border: 3px solid #9f9d9d4a;
    padding: 20px;
    width: 90%;">
                <img src="{{asset('/storage/' .$user->picture)}}" class="twit_profile_photo"
                     alt="missing image">
                <div class="twit_info" style="display: contents">

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
                        </a>
                    </label>
                </div>
                <div class="twit_content">
                    <p>{{$twit->text}}</p>

                    @if($twit->images()->count()>0)
                        @foreach($twit->images()->get() as $key => $image)
                            <img src="{{asset('/storage/'.$image->patch)}}" width="200px" alt="missing image"
                                 id="{{$twit->id . $key}}"
                                 onclick="show(id);">
                        @endforeach
                    @endif
                    <div class="likes">


                        @if( !\Illuminate\Support\Facades\Auth::check() or \App\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id)->likesForTwit()->where('twit_id',$twit->id)->get()->isEmpty())

                            @csrf
                            <p><input type="image" src="{{URL::to('/')}}\img\for_interface\no_like_twit.png"
                                      style="width: 28px" alt="Submit" class="likes_button">



                        @else
                            <p><input type="image" src="{{URL::to('/')}}\img\for_interface\like_twit.png"
                                      style="width: 28px" alt="Submit" class="likes_button">

                                @endif

                                <label class="likes_count"> {{$twit->likes()->count()}}</label>

                                <input type="image" src="{{URL::to('/')}}\img\for_interface\comments.png"
                                       style="width: 28px" alt="Submit" class="likes_button">
                                <label class="likes_count">   {{$twit->comments()->count()}}</label>


                                <input type="image" src="{{URL::to('/')}}\img\for_interface\retwit.png"
                                       style="width: 28px" alt="Submit" class="likes_button">
                                <label class="likes_count"> {{\App\Models\Twit::where('original_twit',$twit->id)->count()}}</label>

                    </div>
                    <div id="show" class="centered_div">
                        <center>
                            <p id="show_pic"></p>
                        </center>
                    </div>
                </div>
            </div>


            <div class="likes">


                <p><img src="{{URL::to('/')}}\img\for_interface\no_like_twit.png"
                        style="width: 28px" class="likes_button">

                    <label class="likes_count">0</label>
                    <img src="{{URL::to('/')}}\img\for_interface\comments.png"
                         style="width: 28px"
                         class="likes_button">
                    <label class="likes_count"> 0</label>

                    <img src="{{URL::to('/')}}\img\for_interface\retwit.png"
                         style="width: 28px"
                         class="likes_button">
                    <label class="likes_count"> 0</label>

            </div>


        </div>
        <div class="other">


            <button type="submit" id="button" name="retwit" value="1">Создать</button>

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
