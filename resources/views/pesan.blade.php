<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pesan Masuk</title>
</head>

<body>
    <h1>Daftar Pesan Masuk</h1>

    @forelse ($pesanList as $baris)
        <p>
            <strong>{{ $baris->nama }}</strong> ({{ $baris->email }}) —
            {{ $baris->tanggal }}<br>
            {{ $baris->subjek }}<br>
            {{ $baris->pesan }}
        </p>
        <hr>
    @empty
        <p>Belum ada pesan masuk.</p>
    @endforelse
</body>

</html>