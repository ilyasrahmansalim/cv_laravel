<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    // Menampilkan halaman daftar skill + form
    public function index()
    {
        $skills = Skill::orderBy('id', 'desc')->get();

        return view('admin.index', compact('skills'));
    }

    // Pengganti skill_tambah.php (Proses simpan baru)
    public function store(Request $request)
    {
        $request->validate([
            'nama_skill' => 'required|string|max:255',
            'tingkat'    => 'required|string',
        ]);

        Skill::create([
            'nama_skill' => $request->nama_skill,
            'tingkat'    => $request->tingkat,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill berhasil ditambahkan!');
    }

    // Pengganti skill_edit.php (Proses update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_skill' => 'required|string|max:255',
            'tingkat'    => 'required|string',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update([
            'nama_skill' => $request->nama_skill,
            'tingkat'    => $request->tingkat,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill berhasil diperbarui!');
    }

    // Pengganti skill_hapus.php (Proses delete)
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Skill berhasil dihapus!');
    }
}