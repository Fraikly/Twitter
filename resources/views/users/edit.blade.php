@extends('layouts.header')
@section('content')

    <form action="{{route('users.update',$user->id)}}" method="post">
        @csrf
        @method('patch')
        <p>Profile photo</p>
        <input type="file" accept="image/*" name="picture">
        @error('picture')
        <p>{{$message}}</p>
        @enderror

        <p>Login</p>
        <p><input type="text" value="{{$user->login}}" name="login"></p>
        @error('login')
        <p>{{$message}}</p>
        @enderror

        <p>About</p>
        <p><textarea name="about">{{$user->about}}</textarea></p>
        @error('about')
        <p>{{$message}}</p>
        @enderror

        <button type="submit"> Сохранить</button>
    </form>
    <a href="{{route('users.show',$user->id)}}">
        <button type="submit"> Отменить</button>
    </a>
    <form action="{{route('users.delete',$user->id)}}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Delete</button>
    </form>

@endsection
