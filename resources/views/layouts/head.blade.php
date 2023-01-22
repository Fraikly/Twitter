<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<title>{{$title ?? 'Авторизация'}} </title>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">

    <link rel="icon" href="{{url('img/for_interface/icon.png')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;800&family=Open+Sans:wght@600&display=swap"
          rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;800&family=Open+Sans:wght@600&display=swap');
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script type="text/javascript" src="{{resource_path()."/js/jquery.js"}}"></script>
</head>
@yield('body')
