@extends('layouts.header')
@section('content')
    <form action="{{route('twits.update',$twit->id)}}" method="post" id="newTwitForm" onsubmit=" return CheckPhotos();">
        @csrf
        @method('patch')
        <p>Текст твита</p>
        <input type="text" maxlength="400" name="text" required value="{{$twit->text}}">

        <p>Фото</p>
        @if($twit->photos!='')
        <div id="old_photo">
            @if(str_contains($twit->photos,"; "))
                @foreach(explode('; ',$twit->photos) as $photo)
                    <img src="{{URL::to('/')}}\img\{{$photo}}" width="100px" alt="missing image">
                @endforeach
            @else
                <img src="{{URL::to('/')}}\img\{{$twit->photos}}" width="100px" alt="missing image">
            @endif

        </div>
        @endif
        <p><input type="checkbox" id="checkbox" onclick="visiblePhotos(); " checked>Оставить старые фото</p>
        <input type="file" accept="image/*" name="photos[]" multiple id="photos">


        <button type="submit" id="button">Обновить</button>
    </form>

    <form action="javascript:history.back()"
          onclick="return confirm('Вы уверены, что хотите выйти? Данные не будут сохранены')">
        <button type="submit">Назад</button>
    </form>
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
                document.getElementById('photos').style.display = 'none';
                document.getElementById('old_photo').style.display = 'block';
            } else {
                document.getElementById('photos').style.display = 'block';
                document.getElementById('old_photo').style.display = 'none';
            }
        }
    </script>

@endsection
