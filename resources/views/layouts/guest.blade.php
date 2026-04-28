<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #1E3A5F;
                --primary-hover: #152a45;
                --bg: #F5F7FA;
                --text: #2E2E2E;
            }
            body {
                font-family: 'Poppins', sans-serif;
                background-color: var(--bg);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                color: var(--text);
            }
            .auth-card {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                width: 100%;
                max-width: 440px;
                padding: 3rem;
                border: 1px solid #E5E7EB;
            }
            .auth-logo {
                font-size: 2rem;
                font-weight: 800;
                color: var(--primary);
                text-align: center;
                margin-bottom: 0.5rem;
                letter-spacing: -0.02em;
            }
            .auth-subtitle {
                text-align: center;
                color: #6B7280;
                font-size: 0.875rem;
                margin-bottom: 2.5rem;
            }
            .form-label {
                display: block;
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--text);
                margin-bottom: 0.5rem;
            }
            .form-input {
                width: 100%;
                padding: 0.75rem 1rem;
                background: white;
                border: 1px solid #D1D5DB;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                color: var(--text);
                transition: all 0.2s;
            }
            .form-input:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.1);
            }
            .btn-auth {
                width: 100%;
                background: var(--primary);
                color: white;
                padding: 0.875rem;
                border-radius: 0.5rem;
                font-weight: 700;
                font-size: 0.875rem;
                border: none;
                cursor: pointer;
                transition: all 0.2s;
                margin-top: 1.5rem;
            }
            .btn-auth:hover {
                background: var(--primary-hover);
                transform: translateY(-1px);
            }
            .auth-link {
                color: var(--primary);
                font-size: 0.875rem;
                text-decoration: none;
                font-weight: 600;
            }
            .auth-link:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="auth-card" id="auth-container">
            <div class="auth-logo">PPDB Online</div>
            <div class="auth-subtitle">Sistem Penerimaan Peserta Didik Baru</div>
            
            {{ $slot }}
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script>
            gsap.from("#auth-container", {
                duration: 0.8,
                y: 30,
                opacity: 0,
                ease: "power3.out"
            });
        </script>
    </body>
</html>
