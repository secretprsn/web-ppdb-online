<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPDB Online') - PPDB Online</title>
    <meta name="description" content="@yield('meta_description', 'Sistem Penerimaan Peserta Didik Baru Online')">
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Scripts & Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <style>
        :root {
            --primary: #1E3A5F;
            --secondary: #3A7CA5;
            --bg: #F5F7FA;
            --text: #2E2E2E;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            line-height: 1.6;
        }

        /* Clean Components */
        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            padding: 24px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #162d4a;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30, 58, 95, 0.2);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: var(--white);
        }

        .gsap-fade {
            /* Visible by default for reliability */
        }
    </style>
</head>
<body>
    @yield('content')

    {{-- GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Simple Fade-in Animation
        document.querySelectorAll('.gsap-fade').forEach(el => {
            gsap.from(el, 
                {
                    opacity: 0,
                    y: 30,
                    duration: 0.8,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: el,
                        start: "top 85%",
                        toggleActions: "play none none none"
                    }
                }
            );
        });
        // Floating Visual Card
        gsap.to('.visual-card', {
            y: -15,
            rotation: 1,
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });
    </script>
    @stack('scripts')
</body>
</html>
