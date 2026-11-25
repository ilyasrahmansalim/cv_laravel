<x-app-layout>
    <x-slot name="header">
        <h1 class="section-title admin-title">Kelola Data Skill</h1>
    </x-slot>

    <style>
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1100;
            padding: 20px;
            background: rgba(0, 0, 0, 0.55);
            justify-content: center;
            align-items: center;
        }
        .modal.active { display: flex; }
    </style>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="admin-section">
        <div class="admin-form-card admin-wide-card">
            <h2>Tambah Skill Baru</h2>
            <form action="{{ route('skills.store') }}" method="POST">
                @csrf
                <div class="admin-form-group">
                    <label for="nama_skill">Nama Skill</label>
                    <input id="nama_skill" type="text" name="nama_skill" value="{{ old('nama_skill') }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="tingkat">Tingkat Penguasaan</label>
                    <select id="tingkat" name="tingkat" required>
                        @foreach (['Beginner', 'Intermediate', 'Advanced', 'Expert'] as $tingkat)
                            <option value="{{ $tingkat }}" {{ old('tingkat') === $tingkat ? 'selected' : '' }}>{{ $tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-admin btn-add">Simpan Skill</button>
            </form>
        </div>
    </section>

    <section class="admin-section">
        <h2 class="section-title">Daftar Skill Saat Ini</h2>
        <div class="table-responsive">
            <table class="admin-table">
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
                            <td class="admin-actions">
                                <button type="button" class="btn-admin btn-edit edit-skill"
                                    data-id="{{ $skill->id }}"
                                    data-nama="{{ $skill->nama_skill }}"
                                    data-tingkat="{{ $skill->tingkat }}">Edit</button>
                                <form action="{{ route('skills.destroy', $skill->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus skill ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-admin btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state">Belum ada data skill.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div id="editModal" class="modal" aria-hidden="true">
        <div class="admin-form-card modal-card" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
            <h2 id="editModalTitle">Edit Data Skill</h2>
            <form id="editForm" method="POST" data-update-url="{{ url('/admin/skills') }}">
                @csrf
                @method('PUT')
                <div class="admin-form-group">
                    <label for="edit_nama_skill">Nama Skill</label>
                    <input type="text" id="edit_nama_skill" name="nama_skill" required>
                </div>
                <div class="admin-form-group">
                    <label for="edit_tingkat">Tingkat Penguasaan</label>
                    <select id="edit_tingkat" name="tingkat" required>
                        @foreach (['Beginner', 'Intermediate', 'Advanced', 'Expert'] as $tingkat)
                            <option value="{{ $tingkat }}">{{ $tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-actions">
                    <button type="submit" class="btn-admin btn-edit">Simpan Perubahan</button>
                    <button type="button" class="btn-admin btn-cancel" id="closeEditModal">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.edit-skill').forEach((button) => {
            button.addEventListener('click', () => {
                const form = document.getElementById('editForm');
                const modal = document.getElementById('editModal');
                form.action = `${form.dataset.updateUrl}/${button.dataset.id}`;
                document.getElementById('edit_nama_skill').value = button.dataset.nama;
                document.getElementById('edit_tingkat').value = button.dataset.tingkat;
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
            });
        });

        document.getElementById('closeEditModal').addEventListener('click', () => {
            const modal = document.getElementById('editModal');
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
        });
    </script>
</x-app-layout>
