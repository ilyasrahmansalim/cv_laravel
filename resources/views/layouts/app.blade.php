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
    <body>
        <header class="site-header">
            <div class="nav-container">
                <a href="{{ route('home') }}" class="logo">Portfolio &amp; CV</a>
                <button type="button" class="hamburger-btn" aria-label="Toggle navigation">☰</button>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('skills.index') }}">Kelola Skill</a></li>
                    <li><a href="{{ route('pesan.index') }}">Pesan Masuk</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link-button">Keluar</button>
                        </form>
                    </li>
                    <li><button type="button" id="theme-toggle" class="theme-toggle-btn" aria-label="Toggle Theme">🌙</button></li>
                </ul>
            </div>
        </header>

        <main class="main-container admin-content">
            @if (isset($header))
                <div class="admin-page-header">{{ $header }}</div>
            @endif
            {{ $slot }}
        </main>
    </body>
</html>
