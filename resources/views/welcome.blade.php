@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<style>
    /* Hero Section Fixes */
    .hero-section {
        background: linear-gradient(135deg, #1E3A5F 0%, #152a45 100%);
        padding: 10rem 2rem;
        color: white;
        text-align: left;
        position: relative;
        overflow: hidden;
    }
    .hero-pattern {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0.05;
        background-image: radial-gradient(#fff 1px, transparent 1px);
        background-size: 30px 30px;
    }
    .floating-shape {
        position: absolute;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), transparent);
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        z-index: 1;
    }
    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        align-items: center;
        gap: 4rem;
    }
    .hero-visual {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .hero-badge {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1.25rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 2rem;
        display: inline-block;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        letter-spacing: -0.03em;
    }
    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.8);
        max-width: 600px;
        margin-bottom: 3.5rem;
        line-height: 1.6;
    }
    
    .visual-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1);
        padding: 2.5rem;
        border-radius: 2rem;
        width: 100%;
        max-width: 400px;
        transform: rotate(3deg);
        position: relative;
    }
    .visual-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .visual-icon {
        width: 3rem; height: 3rem;
        background: rgba(255,255,255,0.1);
        border-radius: 0.75rem;
        display: flex; align-items: center; justify-content: center;
    }
    
    /* Navbar Fix */
    .custom-nav {
        background: white;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 4rem;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .nav-logo {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1E3A5F;
        text-decoration: none;
    }
    .nav-logo span { color: #3A7CA5; }
    .nav-links { display: flex; align-items: center; gap: 2.5rem; }
    .nav-links a { text-decoration: none; color: #1E3A5F; font-weight: 600; font-size: 0.9375rem; transition: color 0.2s; }
    .nav-links a:hover { color: #3A7CA5; }

    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        color: #1E3A5F;
        cursor: pointer;
        padding: 0.5rem;
    }

    .mobile-nav {
        position: fixed;
        top: 0; right: -100%;
        width: 80%; height: 100vh;
        background: white;
        z-index: 2000;
        padding: 4rem 2rem;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -10px 0 30px rgba(0,0,0,0.1);
    }
    .mobile-nav.active { right: 0; }
    .mobile-nav a {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1E3A5F;
        text-decoration: none;
    }
    .mobile-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(30, 58, 95, 0.4);
        backdrop-filter: blur(4px);
        z-index: 1500;
        display: none;
    }
    .mobile-overlay.active { display: block; }

    .btn-register { background: #1E3A5F; color: white !important; padding: 0.75rem 1.75rem; border-radius: 0.75rem; transition: all 0.2s; }
    .btn-register:hover { background: #152a45; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(30,58,95,0.2); }

    .hero-section {
        background: linear-gradient(135deg, #1E3A5F 0%, #3A7CA5 100%);
        min-height: 90vh;
        display: flex;
        align-items: center;
        padding: 6rem 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    /* Media Queries */
    @media (max-width: 1024px) {
        .hero-grid { grid-template-columns: 1fr; text-align: center; gap: 4rem; }
        .hero-content h1 { font-size: 3rem; }
        .hero-btns { justify-content: center; }
        .nav-links { display: none; }
        .mobile-menu-btn { display: block; }
    }

    @media (max-width: 768px) {
        .section-padding { padding: 5rem 1.5rem; }
        .section-title h2 { font-size: 2.25rem; }
        .hero-content h1 { font-size: 2.5rem; }
        .grid-container { grid-template-columns: 1fr; }
        .major-card { padding: 2rem; }
    }
    
    /* Stats Grid Fix */
    .stats-container {
        max-width: 1200px;
        margin: -3rem auto 3rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        padding: 0 2rem;
        position: relative;
        z-index: 10;
    }
    .stat-card-home {
        background: white;
        padding: 2.5rem;
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px rgba(30, 58, 95, 0.08);
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    .stat-num { font-size: 2.5rem; font-weight: 800; color: #1E3A5F; }
    .stat-text { font-size: 0.75rem; font-weight: 700; color: #6B7280; text-transform: uppercase; letter-spacing: 0.05em; }

    .gsap-fade { opacity: 1; transition: opacity 0.3s ease; } 

    .section-padding { padding: 8rem 2rem; position: relative; overflow: hidden; }
    .section-title { text-align: center; margin-bottom: 5rem; position: relative; z-index: 2; }
    .section-title h2 { font-size: 2.75rem; font-weight: 800; color: #1E3A5F; margin-bottom: 1.25rem; letter-spacing: -0.02em; }
    .section-title .divider { width: 80px; height: 5px; background: #3A7CA5; margin: 0 auto; border-radius: 10px; }

    .bg-texture-complex {
        background-color: #F8FAFC;
        background-image: 
            linear-gradient(135deg, #f1f5f9 25%, transparent 25%), 
            linear-gradient(225deg, #f1f5f9 25%, transparent 25%), 
            linear-gradient(45deg, #f1f5f9 25%, transparent 25%), 
            linear-gradient(315deg, #f1f5f9 25%, transparent 25%);
        background-position: 10px 0, 10px 0, 0 0, 0 0;
        background-size: 20px 20px;
        background-repeat: repeat;
        position: relative;
    }

    .bg-texture-grid {
        background-color: #FFFFFF;
        background-image: 
            linear-gradient(#f1f5f9 1.5px, transparent 1.5px), 
            linear-gradient(90deg, #f1f5f9 1.5px, transparent 1.5px);
        background-size: 50px 50px;
        position: relative;
    }



    .geometric-accent {
        position: absolute;
        border: 2px solid #1E3A5F;
        opacity: 0.03;
        pointer-events: none;
        z-index: 1;
    }

    .edu-accent-text {
        position: absolute;
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 10rem;
        opacity: 0.02;
        color: #1E3A5F;
        pointer-events: none;
        z-index: 1;
        line-height: 1;
    }

    .grid-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        position: relative;
        z-index: 2;
    }

    .major-card {
        background: white;
        padding: 2.5rem;
        border-radius: 1.5rem;
        border: 1px solid #F1F5F9;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .major-card:hover { transform: translateY(-8px); border-color: #3A7CA5; box-shadow: 0 20px 40px rgba(30, 58, 95, 0.08); }

    .btn-hero-primary { background: white; color: #1E3A5F; padding: 1.125rem 2.5rem; border-radius: 1rem; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.2s; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .btn-hero-primary:hover { background: #F8FAFC; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(0,0,0,0.15); }
    
    .btn-hero-outline { border: 2px solid white; color: white; padding: 1rem 2.5rem; border-radius: 1rem; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.2s; }
    .btn-hero-outline:hover { background: white; color: #1E3A5F; transform: translateY(-3px); }

    .footer-navy {
        background: #1E3A5F;
        padding: 6rem 2rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .footer-pattern {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 20px 20px;
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.75rem; }
        .hero-content { grid-template-columns: 1fr; text-align: center; }
        .hero-visual { display: flex; transform: scale(0.85); margin-top: 2rem; }
        .visual-card { max-width: 320px; }
        .stats-container { grid-template-columns: 1fr; margin-top: -3rem; gap: 1rem; }
        .custom-nav { padding: 0 1.5rem; }
        .nav-links { display: none; }
    }
</style>

<nav class="custom-nav">
    <a href="/" class="nav-logo">PPDB <span>Online</span></a>
    <div class="nav-links">
        <a href="#jadwal">Jadwal</a>
        <a href="#jurusan">Jurusan</a>
        @auth
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="btn-primary">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Masuk</a>
            <a href="{{ route('register') }}" class="btn-register">Daftar Sekarang</a>
        @endauth
    </div>
    <button class="mobile-menu-btn" id="mobile-toggle">
        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
    </button>
</nav>

<div class="mobile-overlay" id="mobile-overlay"></div>
<div class="mobile-nav" id="mobile-nav">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 2rem;">
        <button id="mobile-close" style="background: none; border: none; color: #1E3A5F;">
            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <a href="#jadwal">Jadwal Pelaksanaan</a>
    <a href="#jurusan">Pilihan Jurusan</a>
    <a href="{{ route('login') }}">Masuk</a>
    <a href="{{ route('register') }}">Daftar Sekarang</a>
</div>

<section class="hero-section">
    <div class="hero-pattern"></div>
    <div class="floating-shape" style="width: 300px; height: 300px; top: -100px; right: -50px;"></div>
    <div class="floating-shape" style="width: 200px; height: 200px; bottom: -50px; left: -50px; opacity: 0.1;"></div>
    
    <div class="hero-content gsap-fade">
        <div class="hero-text">
            <span class="hero-badge">Pendaftaran TA 2026/2027 Dibuka</span>
            <h1 class="hero-title">Wujudkan Masa Depan <br>Pendidikan Terbaik.</h1>
            <p class="hero-subtitle">Platform resmi pendaftaran siswa baru. Proses transparan, mudah, dan terintegrasi untuk mendukung langkah pertama Anda menuju kesuksesan.</p>
            <div style="display: flex; gap: 1.5rem;">
                <a href="{{ route('register') }}" class="btn-hero-primary">Mulai Pendaftaran</a>
                <a href="#jadwal" class="btn-hero-outline">Lihat Jadwal</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="visual-card">
                <div class="visual-item">
                    <div class="visual-icon">
                        <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 1rem;">Proses Cepat</div>
                        <div style="font-size: 0.8rem; opacity: 0.6;">Hanya butuh 5 menit</div>
                    </div>
                </div>
                <div class="visual-item">
                    <div class="visual-icon">
                        <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 1rem;">Full Online</div>
                        <div style="font-size: 0.8rem; opacity: 0.6;">Tanpa perlu datang ke sekolah</div>
                    </div>
                </div>
                <div class="visual-item" style="border: none; margin: 0; padding: 0;">
                    <div class="visual-icon">
                        <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 1rem;">Real-time</div>
                        <div style="font-size: 0.8rem; opacity: 0.6;">Pantau status verifikasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="stats-container gsap-fade">
    <div class="stat-card-home">
        <span class="stat-num">{{ $majors->count() }}</span>
        <span class="stat-text">Program Studi</span>
    </div>
    <div class="stat-card-home">
        <span class="stat-num">{{ $majors->sum('kuota') }}</span>
        <span class="stat-text">Kapasitas Total</span>
    </div>
    <div class="stat-card-home" style="border-right: none;">
        <span class="stat-num">{{ $majors->sum('registrations_count') }}</span>
        <span class="stat-text">Pendaftar</span>
    </div>
</div>

<section id="jadwal" class="section-padding bg-texture-complex">
    <div class="geometric-accent" style="width: 200px; height: 200px; transform: rotate(45deg); top: 10%; right: -100px;"></div>
    <div class="geometric-accent" style="width: 150px; height: 150px; border-radius: 50%; bottom: 10%; left: -75px;"></div>
    <div class="edu-accent-text" style="top: 50%; left: 5%; transform: translateY(-50%);">PPDB</div>
    
    <div class="section-title gsap-fade">
        <h2>Jadwal Pelaksanaan</h2>
        <div class="divider"></div>
    </div>
    <div style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 1.25rem; position: relative; z-index: 2;">
        @foreach($schedules as $schedule)
            <div class="card gsap-fade" style="display: flex; justify-content: space-between; align-items: center; padding: 2.5rem; border-radius: 1.5rem; border: 1px solid #F1F5F9;">
                <div>
                    <h4 style="font-size: 1.25rem; font-weight: 600; color: #1E3A5F; margin-bottom: 0.5rem;">{{ $schedule->nama_kegiatan }}</h4>
                    <p style="color: #64748B; font-size: 1rem;">{{ $schedule->tanggal_mulai->format('d M') }} - {{ $schedule->tanggal_selesai->format('d M Y') }}</p>
                </div>
                <span class="badge-{{ $schedule->status }}" style="padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 700;">{{ strtoupper($schedule->status) }}</span>
            </div>
        @endforeach
    </div>
</section>

<section id="jurusan" class="section-padding bg-texture-grid">
    <div class="geometric-accent" style="width: 100px; height: 300px; top: 20%; left: -50px; opacity: 0.02;"></div>
    <div class="edu-accent-text" style="bottom: 10%; right: 5%; opacity: 0.01;">SMK</div>

    <div class="section-title gsap-fade">
        <h2>Pilihan Jurusan</h2>
        <p style="color: #64748B; margin-top: 1rem; font-size: 1.125rem;">Temukan passion Anda di salah satu program keahlian unggulan kami.</p>
        <div class="divider" style="margin-top: 1.5rem;"></div>
    </div>
    <div class="grid-container">
        @foreach($majors as $major)
            <div class="major-card gsap-fade">
                <div style="background: #F0F7FF; width: 3.5rem; height: 3.5rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <svg width="24" height="24" fill="none" stroke="#1E3A5F" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 style="font-size: 1.35rem; font-weight: 700; color: #1E3A5F; margin-bottom: 1rem;">{{ $major->nama_jurusan }}</h3>
                <p style="color: #64748B; font-size: 0.9375rem; line-height: 1.8; margin-bottom: 2.5rem;">{{ Str::limit($major->deskripsi, 140) }}</p>
                <div style="margin-top: auto; padding-top: 1.5rem; border-top: 1px solid #F1F5F9; display: flex; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 600; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.05em;">Kuota</div>
                        <div style="font-weight: 700; color: #1E3A5F; font-size: 1.125rem;">{{ $major->kuota }} <span style="font-size: 0.8rem; font-weight: 400; color: #94A3B8;">Siswa</span></div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 0.75rem; font-weight: 600; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.05em;">Pendaftar</div>
                        <div style="font-weight: 700; color: #3A7CA5; font-size: 1.125rem;">{{ $major->registrations_count }} <span style="font-size: 0.8rem; font-weight: 400; color: #94A3B8;">Calon</span></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<footer class="footer-navy">
    <div class="footer-pattern"></div>
    <div style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 2;">
        <div style="font-size: 1.75rem; font-weight: 800; color: white; margin-bottom: 1.5rem; letter-spacing: -0.02em;">PPDB <span style="color: #3A7CA5;">Online</span></div>
        <p style="color: rgba(255,255,255,0.6); font-size: 0.9375rem; max-width: 600px; margin: 0 auto 2.5rem;">Platform terpadu penerimaan peserta didik baru dengan proses yang transparan, akuntabel, dan profesional.</p>
        <div style="width: 40px; height: 2px; background: #3A7CA5; margin: 0 auto 2.5rem;"></div>
        <p style="color: rgba(255,255,255,0.4); font-size: 0.8125rem;">&copy; {{ date('Y') }} SMK Negeri Unggulan. Seluruh hak cipta dilindungi.</p>
    </div>
</footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Logic
            const mobileToggle = document.getElementById('mobile-toggle');
            const mobileClose = document.getElementById('mobile-close');
            const mobileNav = document.getElementById('mobile-nav');
            const mobileOverlay = document.getElementById('mobile-overlay');
            const mobileLinks = document.querySelectorAll('.mobile-nav a');

            if (mobileToggle && mobileNav && mobileOverlay) {
                const toggleMenu = (show) => {
                    mobileNav.classList.toggle('active', show);
                    mobileOverlay.classList.toggle('active', show);
                    document.body.style.overflow = show ? 'hidden' : '';
                };

                mobileToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    toggleMenu(true);
                });

                if (mobileClose) {
                    mobileClose.addEventListener('click', (e) => {
                        e.preventDefault();
                        toggleMenu(false);
                    });
                }

                mobileOverlay.addEventListener('click', () => toggleMenu(false));
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => toggleMenu(false));
                });
            }

            // Hero content immediate reveal (since app.js might wait for scroll)
            gsap.to(".hero-content", {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power3.out"
            });
        });
    </script>
@endsection
