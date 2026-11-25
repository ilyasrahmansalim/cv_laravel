<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}" class="auth-logo">Portfolio &amp; CV</a>
        </x-slot>

        <div class="auth-header">
            <h1>Masuk</h1>
            <p>Masuk untuk mengelola akun dan portfolio.</p>
        </div>

        <x-auth-session-status class="auth-status" :status="session('status')" />
        <x-auth-validation-errors class="auth-errors" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <div class="admin-form-group">
                <x-label for="email" value="Email" />
                <x-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="admin-form-group">
                <x-label for="password" value="Kata sandi" />
                <x-input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password" />
            </div>

            <label class="auth-remember" for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-secondary-link" href="{{ route('password.request') }}">Lupa kata sandi?</a>
            @endif

            <button type="submit" class="btn-auth-submit">Masuk</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Buat akun baru</a>
        </div>
    </x-auth-card>
</x-guest-layout>
