<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}" class="auth-logo">Portfolio &amp; CV</a>
        </x-slot>

        <div class="auth-header">
            <h1>Buat Akun Baru</h1>
            <p>Daftar untuk mendapatkan akses ke panel portfolio.</p>
        </div>

        <x-auth-validation-errors class="auth-errors" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            <div class="admin-form-group">
                <x-label for="name" value="Nama" />
                <x-input id="name" class="auth-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="admin-form-group">
                <x-label for="email" value="Email" />
                <x-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="admin-form-group">
                <x-label for="password" value="Kata sandi" />
                <x-input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="admin-form-group">
                <x-label for="password_confirmation" value="Konfirmasi kata sandi" />
                <x-input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <button type="submit" class="btn-auth-submit">Buat Akun</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>
    </x-auth-card>
</x-guest-layout>
