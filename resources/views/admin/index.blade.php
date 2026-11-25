<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Skill — Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* CSS Sederhana untuk Modal Edit */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center; align-items: center;
        }
        .modal.active { display: flex; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-container">
        <h2>Kelola Data Skill</h2>

        <!-- Alert Notifikasi Berhasil -->
        @if (session('success'))
            <div class="alert-success" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Form Tambah Skill Baru -->
        <div class="admin-form-card" style="margin-bottom: 30px;">
            <h3>Tambah Skill Baru</h3>
            <form action="{{ route('skills.store') }}" method="POST">
                @csrf
                <div class="admin-form-group">
                    <label>Nama Skill</label>
                    <input type="text" name="nama_skill" required placeholder="Masukkan nama skill">
                </div>
                <div class="admin-form-group">
                    <label>Tingkat Penguasaan</label>
                    <select name="tingkat" required>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                        <option value="Expert">Expert</option>
                    </select>
                </div>
                <button type="submit" class="btn-admin btn-add">Simpan</button>
            </form>
        </div>

        <!-- Tabel Daftar Skill -->
        <div class="admin-table-card">
            <h3>Daftar Skill Saat Ini</h3>
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Skill</th>
                        <th>Tingkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($skills as $index => $skill)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $skill->nama_skill }}</td>
                            <td>{{ $skill->tingkat }}</td>
                            <td>
                                <!-- Tombol Buka Modal Edit -->
                                <button type="button" class="btn-admin btn-edit" 
                                    onclick="openEditModal({{ $skill->id }}, '{{ $skill->nama_skill }}', '{{ $skill->tingkat }}')">
                                    Edit
                                </button>

                                <!-- Form Hapus -->
                                <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus skill ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-admin btn-cancel" style="background-color: #dc3545; color: white;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">Belum ada data skill.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Pop-up Edit Skill -->
    <div id="editModal" class="modal">
        <div class="admin-form-card" style="background: white; padding: 20px; border-radius: 8px; width: 400px;">
            <h3>Edit Data Skill</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="admin-form-group">
                    <label>Nama Skill</label>
                    <input type="text" id="edit_nama_skill" name="nama_skill" required>
                </div>
                <div class="admin-form-group">
                    <label>Tingkat Penguasaan</label>
                    <select id="edit_tingkat" name="tingkat" required>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                        <option value="Expert">Expert</option>
                    </select>
                </div>
                <button type="submit" class="btn-admin btn-edit">Update</button>
                <button type="button" class="btn-admin btn-cancel" onclick="closeEditModal()">Batal</button>
            </form>
        </div>
    </div>

    <!-- JS Sederhana untuk Modal -->
    <script>
        function openEditModal(id, nama, tingkat) {
            const form = document.getElementById('editForm');
            form.action = `/admin/skills/${id}`;
            document.getElementById('edit_nama_skill').value = nama;
            document.getElementById('edit_tingkat').value = tingkat;
            document.getElementById('editModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }
    </script>
</body>
</html>