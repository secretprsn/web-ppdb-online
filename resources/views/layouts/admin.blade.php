<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - PPDB Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        :root {
            --sidebar-w: 260px;
            /* NAVY THEME (FINAL SPEC) */
            --primary: #1E3A5F;
            --primary-hover: #152a45;
            --secondary: #3A7CA5;
            --bg: #F8FAFC;
            --card-bg: #FFFFFF;
            --text: #334155;
            --text-muted: #64748B;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); margin: 0; -webkit-font-smoothing: antialiased; }
        h1,h2,h3,h4 { font-family: 'Poppins', sans-serif; color: var(--primary); font-weight: 600; margin-top: 0; }
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--primary);
            display: flex; flex-direction: column;
            z-index: 100;
        }
        .sidebar-logo { padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .sidebar-logo h1 { color: white; font-size: 1.125rem; font-weight: 600; margin: 0; }
        .sidebar-logo span { color: rgba(255,255,255,0.4); font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .nav-section-title { color: rgba(255,255,255,0.3); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.1em; padding: 1.25rem 2rem 0.5rem; font-weight: 600; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 2rem; color: rgba(255,255,255,0.6); font-size: 0.875rem; font-weight: 500; transition: color 0.1s; text-decoration: none; }
        .nav-item:hover { color: white; background: rgba(255,255,255,0.03); }
        .nav-item.active { color: white; background: rgba(255,255,255,0.08); font-weight: 600; box-shadow: inset 4px 0 0 white; }
        .nav-item svg { width: 1.125rem; height: 1.125rem; opacity: 0.7; }
        .main-content { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
        .topbar {
            background: white;
            border-bottom: 1px solid #EDF2F7;
            padding: 0 2rem;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 90;
        }
        .topbar-title { font-size: 1rem; font-weight: 600; color: var(--primary); }
        .page-content { padding: 2rem; flex: 1; }
        .btn-primary { background: var(--primary); color: white; padding: 0.6rem 1.25rem; border-radius: 0.5rem; font-weight: 500; font-size: 0.8125rem; transition: opacity 0.1s; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; }
        .btn-primary:hover { opacity: 0.9; }
        .btn-secondary { background: var(--secondary); color: white; padding: 0.6rem 1.25rem; border-radius: 0.5rem; font-weight: 500; font-size: 0.8125rem; transition: opacity 0.1s; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; text-decoration: none; }
        .btn-secondary:hover { opacity: 0.9; }
        .btn-outline-sm { border: 1px solid #E2E8F0; color: var(--text-muted); padding: 0.4rem 0.75rem; border-radius: 0.375rem; font-weight: 500; font-size: 0.75rem; transition: all 0.1s; text-decoration: none; display: inline-flex; align-items: center; gap: 0.375rem; background: white; }
        .btn-outline-sm:hover { border-color: var(--secondary); color: var(--secondary); }
        .btn-danger { background: #EF4444; color: white; padding: 0.4rem 0.75rem; border-radius: 0.375rem; font-weight: 500; font-size: 0.75rem; transition: opacity 0.1s; border: none; cursor: pointer; text-decoration: none; }
        .btn-danger:hover { opacity: 0.9; }
        .btn-warning { background: #D97706; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; font-size: 0.8rem; transition: all 0.2s; border: none; cursor: pointer; }
        .form-input:focus { outline: none; border-color: var(--secondary); box-shadow: 0 0 0 3px rgba(207,157,123,0.1); }
        .form-label { display: block; font-size: 0.8125rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem; }
        .form-error { color: #DC2626; font-size: 0.75rem; margin-top: 0.25rem; }
        .table-wrap { background: white; border-radius: 0.75rem; border: 1px solid #EDF2F7; box-shadow: 0 1px 3px rgba(0,0,0,0.02); overflow-x: auto; }
        .table-base { width: 100%; border-collapse: collapse; min-width: 800px; }
        .table-base th { background: #F8FAFC; padding: 0.875rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 600; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #EDF2F7; }
        .table-base td { padding: 1rem 1.25rem; border-bottom: 1px solid #F1F5F9; font-size: 0.875rem; color: var(--text); }
        .table-base tr:hover td { background: #FBFCFD; }
        .table-base tr:last-child td { border-bottom: none; }
        .badge-pending  { background: #FFF7ED; color: #C2410C; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.7rem; font-weight: 600; border: 1px solid #FFEDD5; white-space: nowrap; }
        .badge-diterima { background: #F0FDF4; color: #15803D; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.7rem; font-weight: 600; border: 1px solid #DCFCE7; white-space: nowrap; }
        .badge-ditolak  { background: #FEF2F2; color: #B91C1C; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.7rem; font-weight: 600; border: 1px solid #FEE2E2; white-space: nowrap; }
        .alert-success { background: #ECFDF5; border-left: 4px solid #10B981; color: #065F46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem; }
        .alert-error   { background: #FEF2F2; border-left: 4px solid #EF4444; color: #991B1B; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem; }
        .stat-card { background: white; border-radius: 0.75rem; padding: 1.5rem; display: flex; align-items: center; gap: 1rem; border: 1px solid #EDF2F7; }
        .stat-icon { width: 3rem; height: 3rem; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; background: #F8FAFC !important; color: var(--primary); }
        .stat-value { font-size: 1.75rem; font-weight: 600; color: var(--primary); line-height: 1.2; }
        .stat-label { font-size: 0.8125rem; color: var(--text-muted); font-weight: 500; margin-top: 0.125rem; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-logo">
            <h1>PPDB Online</h1>
            <span>Panel Administrator</span>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-title">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="nav-section-title">Data PPDB</div>
            <a href="{{ route('admin.students.index') }}" class="nav-item {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Data Siswa
            </a>
            <a href="{{ route('admin.registrations.index') }}" class="nav-item {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Pendaftaran
            </a>
            <a href="{{ route('admin.majors.index') }}" class="nav-item {{ request()->routeIs('admin.majors.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Jurusan
            </a>

            <div class="nav-section-title">Informasi</div>
            <a href="{{ route('admin.announcements.index') }}" class="nav-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                Pengumuman
            </a>
            <a href="{{ route('admin.schedules.index') }}" class="nav-item {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Jadwal
            </a>
        </nav>
        <div style="padding: 1rem 1.25rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <div style="color: rgba(255,255,255,0.9); font-size: 0.8rem; font-weight: 500; margin-bottom: 0.5rem;">{{ auth()->user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="color: rgba(255,255,255,0.5); font-size: 0.75rem; background: none; border: none; cursor: pointer; padding: 0; transition: color 0.15s;">
                    Keluar dari Sistem
                </button>
            </form>
        </div>
    </aside>

    <div class="main-content">
        <header class="topbar">
            <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <span style="font-size: 0.8rem; color: #6B7280;">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
                <a href="{{ route('home') }}" style="font-size: 0.8rem; color: #3A7CA5; font-weight: 500;">Lihat Situs</a>
            </div>
        </header>

        <main class="page-content">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Snappy Entrance
        gsap.from('.sidebar', { x: -260, duration: 0.4, ease: 'power2.out' });
        gsap.from('.topbar', { y: -20, opacity: 0, duration: 0.3, ease: 'power2.out' });

        // Quick Content Fade
        gsap.utils.toArray('.stat-card, .card').forEach((el) => {
            gsap.from(el, {
                scrollTrigger: {
                    trigger: el,
                    start: "top 95%",
                    toggleActions: "play none none none"
                },
                y: 5,
                opacity: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
