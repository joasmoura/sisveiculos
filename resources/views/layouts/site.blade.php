<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="BASE" content="{{ env('APP_URL') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/light-gallery/css/lightgallery.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
        
    </head>
    <body>
        <header class="container">
            {{ $header }}
        </header>

        <main class="container">
            {{ $slot }}
        </main>

        <script src="{{ asset('assets/js/jquery.min.js') }}" defer></script>
        <script src="{{ asset('assets/js/jquery.form.js') }}" defer></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.js') }}" defer></script>
        <script src="{{ asset('assets/plugins/light-gallery/js/lightgallery-all.min.js') }}" defer></script>
        <script src="{{ asset('assets/js/scripts.js') }}" defer></script>
    </body>
</html>