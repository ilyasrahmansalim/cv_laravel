<x-app-layout>
    <x-slot name="header">
        <h1 class="section-title admin-title">Pesan Masuk</h1>
    </x-slot>

    <section class="admin-section">
        <p class="admin-intro">Pesan yang dikirim melalui formulir kontak portfolio.</p>

        @forelse ($pesanList as $baris)
            <article class="card-pesan">
                <div class="card-pesan-header">
                    <div>
                        <h2>{{ $baris->subjek }}</h2>
                        <strong>{{ $baris->nama }}</strong>
                        <a href="mailto:{{ $baris->email }}">{{ $baris->email }}</a>
                    </div>
                    <time>{{ $baris->tanggal }}</time>
                </div>
                <p class="pesan-content">{{ $baris->pesan }}</p>
            </article>
        @empty
            <div class="timeline-card empty-state">Belum ada pesan masuk.</div>
        @endforelse
    </section>
</x-app-layout>
