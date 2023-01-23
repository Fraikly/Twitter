@extends('layouts.header')
@section('content')
    <div class="users">
        <div class="left">
            <p class="nothing_find">Редактирование профиля</p>
            <div class="user_picture">
                <img src="{{asset('/storage/' .$user->picture)}}" width="254px">
            </div>
        </div>
        <div class="profile_options">
            <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <label class="settings">Имя профиля: </label>
                <input type="text" value="{{$user->login}}" name="login" style="
    color: black;
">
                @error('login')
                <p>{{$message}}</p><br>
                @enderror
                <br>
                <label class="settings">Описание профиля</label>
                <br>
                <textarea name="about" class="about" maxlength="160">{{$user->about}}</textarea>
                @error('about')
                <strong>{{$message}}</strong><br>
                @enderror

                <label class="settings">Новое фото профиля: </label>
                <label for="file-upload" class="custom-file-upload">
                    выбрать фото
                </label>
                <input id="file-upload" name="picture" type="file"/>
                @error('picture')
                <strong>{{$message}}</strong><br>
                @enderror
                <br>
                <button type="submit"> Сохранить</button>
            </form>
            <a href="{{route('users.show',$user->id)}}">
                <button type="submit"> Отменить</button>
            </a>

        </div>
        <div class="right">
            <form action="{{route('users.delete',$user->id)}}" method="post"
                  onclick="return confirm('Вы уверены, что хотите удалить страницу?')">
                @csrf
                @method('delete')
                {{--        <button type="submit" style="background-color: #d54343">Удалить</button>--}}
                <input type="image" src="\img\for_interface\delete_twit.png" alt="Submit"
                       style="width: 28px; box-shadow: none; background: none" class="">
            </form>
        </div>


    </div>
@endsection
