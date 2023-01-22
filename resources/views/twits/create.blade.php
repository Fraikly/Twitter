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
                        сегодня в {{date('H:i',time())}}
                    </label>
                </label>
            </div>
            <div class="twit_content">
                <form action="{{route('twits.store')}}" method="post" id="newTwitForm" onsubmit=" return CheckPhotos();"
                      enctype="multipart/form-data">
                    @csrf
                    <p><textarea maxlength="400" name="text" required class="twit_text"
                                 style="    border: 1px solid #595959c2;"></textarea></p>
                    <label for="photos" class="custom-file-upload">
                        выбрать фото
                    </label>
                    <input accept="image/*" name="photos[]" multiple id="photos" type="file"/>
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
        </div>
        <div class="other">


            <button type="submit" id="button">Создать</button>

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








    {{--    <form action="{{route('twits.store')}}" method="post" id="newTwitForm" onsubmit=" return CheckPhotos();" enctype="multipart/form-data">--}}
    {{--    <p>Текст твита</p>--}}
    {{--<input type="text" maxlength="400" name="text" required >--}}
    {{--    <p>Фото</p>--}}
    {{--<input type="file" accept="image/*" name="photos[]"multiple id="photos" >--}}

    {{--        @csrf--}}
    {{--    <button type="submit" id="button">Создать</button>--}}
    {{--    </form>--}}

    {{--    <form action="javascript:history.back()" onclick="return confirm('Вы уверены, что хотите выйти? Данные не будут сохранены')">--}}
    {{--    <button type="submit">Назад</button>--}}
    {{--    </form>--}}
    {{--    <script>--}}
    {{--        function CheckPhotos() {--}}
    {{--            var photos = document.getElementById('photos');--}}
    {{--            if(photos.files.length>3){--}}
    {{--                alert("Кол-во фотографий не должно превышать 3-х");--}}
    {{--                return false;--}}
    {{--            }--}}
    {{--            else--}}
    {{--                return true;--}}

    {{--        }--}}
    {{--    </script>--}}
@endsection
