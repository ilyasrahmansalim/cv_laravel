<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('js/script.js') }}" defer></script>
    </head>
    <body class="admin-body">
        @if (isset($header))
            <header class="admin-nav" style="margin-bottom: 20px;">
                {{ $header }}
            </header>
        @endif

        <div class="admin-container">
            {{ $slot }}
        </div>
    </body>
</html>
