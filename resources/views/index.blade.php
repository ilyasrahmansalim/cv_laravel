<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->nama }} — Portfolio & CV</title>
    
    <!-- Panggil Aset Menggunakan asset() Helper -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>

<body>
    <header class="site-header">
        <div class="nav-container">
            <a href="#" class="logo">{{ $profile->nama }}'s Portfolio</a>

            <button type="button" class="hamburger-btn" aria-label="Toggle navigation">☰</button>

            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#expertise">Expertise</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="{{ route('login') }}" style="border: 1px solid black; padding: 10px;">Admin Login</a></li>
                <li><button type="button" id="theme-toggle" class="theme-toggle-btn"
                        aria-label="Toggle Theme">🌙</button></li>
            </ul>
        </div>
    </header>

    <div class="main-container">
        <header class="hero-section">
            <div class="hero-content">
                @if ($profile->status)
                    <div class="badge-status">Mahasiswa Aktif</div>
                @else
                    <div class="badge-status" style="background-color: #dc3545;">Bukan Mahasiswa Aktif</div>
                @endif

                <h1>Hello, I'm {{ $profile->nama }}
                    @if ($profile->nrp)
                        <br>({{ $profile->nrp }})
                    @endif
                    @if ($profile->prodi)
                        <br>{{ $profile->prodi }}
                    @endif
                </h1>
                <div class="hero-subtitle">{{ $profile->posisi }}</div>
                <p>{{ $profile->deskripsi }}</p>
            </div>
            <div class="hero-image-wrapper">
                <img src="{{ $profile->foto ? asset($profile->foto) : '' }}" alt="{{ $profile->nama }}"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <span class="placeholder-img-text" style="display:none;">Photo Profile</span>
            </div>
        </header>

        <section id="about">
            <h2 class="section-title">Career Summary</h2>
            <p class="summary-text">{{ $profile->deskripsi }}</p>
        </section>

        <section id="skills">
            <h2 class="section-title">Skills</h2>
            <ul style="padding-left: 20px;">
                @forelse ($skills as $skill)
                    <li class="skill-list-item">
                        {{ $skill->nama_skill }} 
                        <span class="skill-level-text">({{ $skill->tingkat }})</span>
                    </li>
                @empty
                    <li>Belum ada data skill.</li>
                @endforelse
            </ul>
        </section>

        <section id="experience">
            <h2 class="section-title">Experience & Organization</h2>
            <div class="timeline-list">
                @foreach ($experience as $exp)
                    <div class="timeline-card accordion-item">
                        <div class="accordion-header">
                            <div class="header-left">
                                <div class="timeline-logo-box">
                                    <img src="{{ $exp->logo ? asset($exp->logo) : '' }}" alt="{{ $exp->instansi }}"
                                        onerror="this.style.display='none';">
                                </div>
                                <div class="timeline-details">
                                    <h3>{{ $exp->posisi }}</h3>
                                    <div class="institution">{{ $exp->instansi }}</div>
                                </div>
                            </div>
                            <div class="header-right">
                                <span class="timeline-date">{{ $exp->tahun }}</span>
                                <span class="accordion-icon">+</span>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <div class="desc">{{ $exp->deskripsi }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="education">
            <h2 class="section-title">Education</h2>
            <div class="timeline-list">
                @forelse ($education as $edu)
                    <div class="timeline-card accordion-item">
                        <div class="accordion-header">
                            <div class="header-left">
                                <div class="timeline-logo-box">
                                    <img src="{{ $edu->logo && filter_var($edu->logo, FILTER_VALIDATE_URL) ? $edu->logo : asset($edu->logo) }}" alt="{{ $edu->instansi }}">
                                </div>
                                <div class="timeline-details">
                                    <h3>{{ $edu->jurusan }}</h3>
                                    <div class="institution">{{ $edu->instansi }}</div>
                                </div>
                            </div>
                            <div class="header-right">
                                <span class="timeline-date">{{ $edu->tahun }}</span>
                                <span class="accordion-icon">+</span>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <div class="desc">{{ $edu->deskripsi }}</div>
                        </div>
                    </div>
                @empty
                    <p>Belum ada data pendidikan.</p>
                @endforelse
            </div>
        </section>

        <section id="projects">
            <h2 class="section-title">Projects Showcase</h2>

            <form action="{{ url('/#projects') }}" method="GET" class="filter-form">
                <input type="text" name="search" placeholder="Cari judul project..."
                    value="{{ $searchKey }}" class="filter-input">

                <select name="kategori" class="filter-select">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ strcasecmp($kategoriFilter, $category) === 0 ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn-submit" style="width: auto; padding: 10px 20px;">Filter</button>
                <a href="{{ url('/#projects') }}" class="btn-reset">Reset</a>
            </form>

            @if ($filteredProjects->isEmpty())
                <div style="background-color: #fff; padding: 25px; border-radius: 12px; text-align: center; border: 1px solid #eee;">
                    <p style="margin: 0; color: #666; font-weight: 500;">Maaf, project tidak ditemukan berdasarkan pencarian atau filter Anda.</p>
                </div>
            @else
                <div class="expertise-grid">
                    @foreach ($filteredProjects as $prj)
                        <div class="expertise-card" style="cursor: default;">
                            <div class="card-body">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="font-size: 12px; font-weight: 700; background: #111; color: #fff; padding: 2px 8px; border-radius: 12px;">{{ $prj->kategori }}</span>
                                    <span style="font-size: 12px; font-weight: 600; opacity: 0.7;">{{ $prj->tahun }}</span>
                                </div>
                                <h3>{{ $prj->judul }}</h3>
                                <p>{{ $prj->deskripsi }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <section id="expertise">
            <h2 class="section-title">Expertise</h2>
            <div class="expertise-grid">
                @forelse ($expertises as $expertise)
                    <div class="expertise-card">
                        <div class="card-img-box">
                            <img src="{{ $expertise->gambar ? asset($expertise->gambar) : '' }}"
                                alt="{{ $expertise->judul }}" onerror="this.style.display='none';">
                        </div>
                        <div class="card-body">
                            <h3>{{ $expertise->judul }}</h3>
                            <p>{{ $expertise->deskripsi }}</p>
                        </div>
                    </div>
                @empty
                    <p>Belum ada data keahlian.</p>
                @endforelse
            </div>
        </section>

        <div class="contact-section" id="contact">
            <h2>Let's build something great together.</h2>
            <p>Have a project in mind or want to collaborate? Feel free to reach out.</p>

            <!-- Alert Notifikasi Berhasil -->
            @if (session('status'))
                <div class="alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('pesan.store') }}" method="POST" class="contact-form">
                @csrf <!-- Token Keamanan Wajib Laravel -->

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama Anda"
                        value="{{ old('name') }}">
                    @error('name')
                        <small class="form-error-msg" style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="nama@email.com"
                        value="{{ old('email') }}">
                    @error('email')
                        <small class="form-error-msg" style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subjek">Subjek</label>
                    <input type="text" id="subjek" name="subjek" placeholder="Subjek pesan Anda"
                        value="{{ old('subjek') }}">
                    @error('subjek')
                        <small class="form-error-msg" style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pesan">Pesan</label>
                    <textarea id="pesan" name="pesan" rows="5"
                        placeholder="Tuliskan pesan atau project Anda di sini...">{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <small class="form-error-msg" style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Kirim Pesan</button>
            </form>
        </div>

        <footer class="site-footer">
            <div class="main-container">
                <p>&copy; {{ date('Y') }} {{ $profile->nama }}. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>