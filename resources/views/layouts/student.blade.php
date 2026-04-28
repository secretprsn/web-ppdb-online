<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Siswa') - PPDB Online</title>
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
            --bg: #F5F7FA;
            --card-bg: #FFFFFF;
            --text: #2E2E2E;
            --text-muted: #6B7280;
            --accent: #3A7CA5;
        }

        body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); margin: 0; line-height: 1.6; overflow-x: hidden; }
        h1,h2,h3,h4 { font-family: 'Poppins', sans-serif; color: var(--primary); font-weight: 700; }
        
        .topnav { background: white; padding: 0 4rem; display: flex; align-items: center; justify-content: space-between; height: 80px; position: sticky; top: 0; z-index: 100; border-bottom: 1px solid #F1F5F9; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .topnav-brand { color: var(--primary); font-family: 'Poppins', sans-serif; font-size: 1.35rem; font-weight: 800; text-decoration: none; display: flex; align-items: center; gap: 0.875rem; letter-spacing: -0.02em; }
        .topnav-links { display: flex; align-items: center; gap: 1rem; }
        .topnav-link { color: var(--text-muted); font-size: 0.9375rem; font-weight: 600; padding: 0.625rem 1.25rem; border-radius: 0.75rem; text-decoration: none; transition: all 0.2s; }
        .topnav-link:hover { color: var(--primary); background: #F8FAFC; }
        .topnav-link.active { background: #F0F7FF; color: var(--primary); }
        
        .page-wrap { max-width: 1100px; margin: 0 auto; padding: 3rem 1.5rem; position: relative; z-index: 10; }
        .card { background: white; border-radius: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #E5E7EB; padding: 2rem; }
        
        .btn-primary { background: var(--primary); color: white; padding: 0.75rem 1.75rem; border-radius: 0.625rem; font-weight: 700; font-size: 0.9375rem; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; text-decoration: none; }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-1px); }
        .btn-secondary { background: var(--secondary); color: white; padding: 0.875rem 2rem; border-radius: 1rem; font-weight: 700; font-size: 0.9375rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.625rem; border: none; cursor: pointer; text-decoration: none; }
        .btn-secondary:hover { background: #2d6182; transform: translateY(-3px); box-shadow: 0 10px 25px rgba(58, 124, 165, 0.2); }
        
        .form-input { width: 100%; padding: 0.875rem 1.25rem; border: 1.5px solid #E5E7EB; background: #FFFFFF; border-radius: 1rem; font-size: 1rem; color: var(--text); transition: all 0.3s; }
        .form-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 4px rgba(16,185,129,0.1); }
        .form-label { display: block; font-size: 0.875rem; font-weight: 700; color: var(--primary); margin-bottom: 0.625rem; letter-spacing: 0.01em; }
        .form-error { color: #DC2626; font-size: 0.75rem; margin-top: 0.25rem; }
        .badge-pending  { background: #FEF3C7; color: #92400E; padding: 0.25rem 0.875rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-diterima { background: #D1FAE5; color: #065F46; padding: 0.25rem 0.875rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-ditolak  { background: #FEE2E2; color: #991B1B; padding: 0.25rem 0.875rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .alert-success { background: #D1FAE5; border-left: 4px solid #059669; color: #065F46; padding: 0.875rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem; }
        .alert-error   { background: #FEE2E2; border-left: 4px solid #DC2626; color: #991B1B; padding: 0.875rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem; }
        .alert-info    { background: #DBEAFE; border-left: 4px solid #2563EB; color: #1E40AF; padding: 0.875rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem; }
        /* Progress Steps */
        .step-bar { display: flex; align-items: center; margin-bottom: 2rem; }
        .step-item { display: flex; align-items: center; gap: 0.5rem; }
        .step-circle { width: 2rem; height: 2rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 600; }
        .step-circle.active { background: var(--primary); color: white; }
        .step-circle.done { background: #059669; color: white; }
        .step-circle.inactive { background: #E5E7EB; color: #9CA3AF; }
        .step-label { font-size: 0.8rem; font-weight: 500; }
        .step-label.active { color: var(--primary); }
        .step-label.done { color: #059669; }
        .step-label.inactive { color: #9CA3AF; }
        .step-line { flex: 1; height: 2px; background: #E5E7EB; margin: 0 0.75rem; }
        .step-line.done { background: #059669; }
    </style>
</head>
<body>


    <nav class="topnav">
        <a href="{{ route('home') }}" class="topnav-brand">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="8" fill="var(--primary)"/><path d="M16 8L8 14V24H14V18H18V24H24V14L16 8Z" fill="white"/></svg>
            PPDB Online
        </a>
        <div class="topnav-links">
            <a href="{{ route('student.dashboard') }}" class="topnav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('student.registration.step1') }}" class="topnav-link {{ request()->routeIs('student.registration.*') ? 'active' : '' }}">Pendaftaran</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="topnav-link" style="background: none; border: none; cursor: pointer; font-family: inherit;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="page-wrap">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Subtle Entrance Animations
        window.addEventListener('load', () => {
            gsap.from('.topnav', { y: -20, opacity: 0, duration: 0.8, ease: "power2.out" });
            
            gsap.utils.toArray('.card').forEach((card) => {
                gsap.from(card, {
                    scrollTrigger: {
                        trigger: card,
                        start: "top 95%",
                        toggleActions: "play none none none"
                    },
                    y: 20,
                    opacity: 0,
                    duration: 0.6,
                    ease: "power2.out"
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
