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
    <body class="auth-page">
        <header class="site-header">
            <div class="nav-container">
                <a href="{{ route('home') }}" class="logo">Portfolio &amp; CV</a>
                <button type="button" class="hamburger-btn" aria-label="Toggle navigation">☰</button>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('login') }}">Masuk</a></li>
                    <li><a href="{{ route('register') }}">Buat Akun</a></li>
                    <li><button type="button" id="theme-toggle" class="theme-toggle-btn" aria-label="Toggle Theme">🌙</button></li>
                </ul>
            </div>
        </header>
        <main class="auth-container">
            {{ $slot }}
        </main>
    </body>
</html>
