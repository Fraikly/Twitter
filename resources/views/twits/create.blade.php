@extends('layouts.header')
@section('content')
    <form action="{{route('twits.store')}}" method="post" id="newTwitForm" onsubmit=" return CheckPhotos();">
    <p>Текст твита</p>
<input type="text" maxlength="400" name="text" required >
    <p>Фото</p>
<input type="file" accept="image/*" name="photos[]"multiple id="photos">

        @csrf
    <button type="submit" id="button">Создать</button>
    </form>

    <form action="javascript:history.back()" onclick="return confirm('Вы уверены, что хотите выйти? Данные не будут сохранены')">
    <button type="submit">Назад</button>
    </form>
    <script>
        function CheckPhotos() {
            var photos = document.getElementById('photos');
            if(photos.files.length>3){
                alert("Кол-во фотографий не должно превышать 3-х");
                return false;
            }
            else
                return true;

        }
    </script>
@endsection
