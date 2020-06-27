<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet"    href="{{ asset('css/app.css') }}" >
    <link rel="stylesheet"    href="{{ asset('css/basic.css') }}" >
    <link rel="stylesheet"    href="{{ asset('css/dropzone.css') }}" >
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
   
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
  <script src="{{ asset('js/show-likes.js') }}" defer></script>
  <script src="{{ asset('js/chat.js') }}"></script>
  <script src="{{ asset('js/editpost.js') }}" defer></script>
  <script src="{{ asset('js/toggle-checkbox.js') }}" defer></script>
  <script src="{{ asset('js/dropzone.js') }}" defer></script>
  
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <main class="{{ (Auth::guest()) ? '' : 'py-4'}}">
            @yield('content')
        </main>
    </div>
</body>
</html>
