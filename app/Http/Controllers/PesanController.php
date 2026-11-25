<?php

namespace App\Http\Controllers;

use App\Models\FormEmail;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    // Pengganti pesan.php (Menampilkan daftar pesan)
    public function index()
    {
        $pesanList = FormEmail::orderBy('id', 'desc')->get();

        return view('pesan', compact('pesanList'));
    }

    // Pengganti kirim.php (Proses simpan pesan)
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan'  => 'required|string',
        ]);

        // Simpan ke database
        FormEmail::create([
            'nama'   => $validated['name'],
            'email'  => $validated['email'],
            'subjek' => $validated['subjek'],
            'pesan'  => $validated['pesan'],
        ]);

        // Redirect kembali ke halaman utama dengan pesan sukses
        return redirect('/')->with('status', 'Pesan anda sudah terkirim!');
    }
}