<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>

        .login-s2 {
            background: #fff;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .login-s2:before {
            content: '';
            position: absolute;
            height: 206%;
            width: 97%;
            background: #fcfcff;
            border-radius: 50%;
            left: -42%;
            z-index: -1;
            top: -47%;
            box-shadow: inset 0 0 51px rgba(0, 0, 0, 0.1);
        }
        </style>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased login-s2">
            {{ $slot }}
        </div>
    </body>
</html>
