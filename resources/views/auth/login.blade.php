<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In — PhotoShare</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --dark: #0b0b18;
            --gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        /* ── Layout ───────────────────────────── */
        .auth-wrap {
            display: flex;
            min-height: 100vh;
        }

        /* ── Left panel ───────────────────────── */
        .auth-left {
            display: none;
            width: 42%;
            background: var(--dark);
            position: relative;
            overflow: hidden;
            padding: 3rem;
            flex-direction: column;
            justify-content: space-between;
        }

        @media (min-width: 992px) { .auth-left { display: flex; } }

        .left-glow-1 {
            position: absolute;
            top: -120px; left: -100px;
            width: 480px; height: 480px;
            background: radial-gradient(circle, rgba(99,102,241,0.3) 0%, transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }
        .left-glow-2 {
            position: absolute;
            bottom: -150px; right: -80px;
            width: 420px; height: 420px;
            background: radial-gradient(circle, rgba(168,85,247,0.22) 0%, transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        .left-brand {
            display: inline-flex;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .auth-logo {
            display: block;
            width: auto;
            height: 128px;
            max-width: 460px;
            object-fit: contain;
        }

        @media (max-width: 575.98px) {
            .auth-logo {
                height: 96px;
                max-width: 330px;
            }
        }

        .left-content {
            position: relative;
            z-index: 1;
        }

        .left-content h2 {
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 800;
            color: #fff;
            letter-spacing: -1px;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .left-content p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.65;
        }

        .left-features {
            list-style: none;
            padding: 0;
            margin: 2rem 0 0;
        }
        .left-features li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #94a3b8;
            font-size: 0.88rem;
            margin-bottom: 0.85rem;
        }
        .left-features li .feat-dot {
            width: 28px; height: 28px;
            border-radius: 8px;
            background: rgba(99,102,241,0.15);
            border: 1px solid rgba(99,102,241,0.25);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .left-features li .feat-dot i {
            font-size: 0.85rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .left-footer {
            position: relative;
            z-index: 1;
        }
        .left-footer p {
            color: #1e293b;
            font-size: 0.78rem;
            margin: 0;
        }

        /* ── Right panel ──────────────────────── */
        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.5rem;
            background: #f8fafc;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
        }

        /* Mobile brand shown only on small screens */
        .mobile-brand {
            display: inline-flex;
            align-items: center;
            margin-bottom: 1.75rem;
            text-decoration: none;
        }
        @media (min-width: 992px) { .mobile-brand { display: none; } }

        .auth-card h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.8px;
            margin-bottom: 0.4rem;
        }

        .auth-card .subtitle {
            color: #64748b;
            font-size: 0.92rem;
            margin-bottom: 2rem;
        }

        /* ── Form ─────────────────────────────── */
        .form-label {
            font-size: 0.83rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.68rem 0.9rem;
            font-size: 0.92rem;
            color: #0f172a;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
            outline: none;
        }
        .form-control.is-invalid {
            border-color: #ef4444;
        }
        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239,68,68,0.12);
        }

        .field-error {
            font-size: 0.78rem;
            color: #ef4444;
            margin-top: 0.3rem;
        }

        .pw-wrapper {
            position: relative;
        }
        .pw-toggle {
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0;
            color: #94a3b8;
            cursor: pointer;
            font-size: 1rem;
            line-height: 1;
            transition: color 0.2s;
        }
        .pw-toggle:hover { color: var(--primary); }

        .form-check-input {
            border-color: #cbd5e1;
            border-radius: 4px;
        }
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .form-check-label {
            font-size: 0.83rem;
            color: #475569;
        }

        /* ── Submit button ────────────────────── */
        .btn-submit {
            width: 100%;
            background: var(--gradient);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.78rem 1rem;
            font-size: 0.97rem;
            font-weight: 600;
            transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 6px 22px rgba(99,102,241,0.32);
        }
        .btn-submit:hover {
            opacity: 0.93;
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(99,102,241,0.42);
            color: #fff;
        }
        .btn-submit:active { transform: translateY(0); }

        /* ── Misc ─────────────────────────────── */
        .forgot-link {
            font-size: 0.82rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { text-decoration: underline; color: var(--primary); }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.5rem 0;
            color: #cbd5e1;
            font-size: 0.78rem;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .register-prompt {
            text-align: center;
            font-size: 0.87rem;
            color: #64748b;
        }
        .register-prompt a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }
        .register-prompt a:hover { text-decoration: underline; }

        .session-status {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            border-radius: 10px;
            padding: 0.65rem 0.9rem;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
        }

        .back-link {
            position: fixed;
            top: 1.25rem;
            left: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            transition: color 0.2s;
            z-index: 100;
        }
        .back-link:hover { color: #475569; }
        @media (min-width: 992px) {
            .back-link { color: rgba(255,255,255,0.45); }
            .back-link:hover { color: rgba(255,255,255,0.85); }
        }
    </style>
</head>
<body>

    <a href="/" class="back-link">
        <i class="bi bi-arrow-left"></i> Back to home
    </a>

    <div class="auth-wrap">

        <!-- ── Left branding panel ─────────────── -->
        <div class="auth-left">
            <div class="left-glow-1"></div>
            <div class="left-glow-2"></div>

            <div class="left-brand">
                <img src="{{ asset('logo.png') }}" alt="PhotoShare" class="auth-logo">
            </div>

            <div class="left-content">
                <h2>Welcome back to your creative space</h2>
                <p>Sign in to access your photos, discover new work, and engage with the community.</p>
                <ul class="left-features">
                    <li>
                        <span class="feat-dot"><i class="bi bi-cloud-upload-fill"></i></span>
                        Upload and manage your photo portfolio
                    </li>
                    <li>
                        <span class="feat-dot"><i class="bi bi-search-heart"></i></span>
                        Discover photos from creators worldwide
                    </li>
                    <li>
                        <span class="feat-dot"><i class="bi bi-star-fill"></i></span>
                        Rate and comment on amazing photography
                    </li>
                </ul>
            </div>

            <div class="left-footer">
                <p>&copy; 2026 PhotoShare</p>
            </div>
        </div>

        <!-- ── Right form panel ────────────────── -->
        <div class="auth-right">
            <div class="auth-card">

                <a href="/" class="mobile-brand">
                    <img src="{{ asset('logo.png') }}" alt="PhotoShare" class="auth-logo">
                </a>

                <h1>Sign in</h1>
                <p class="subtitle">Don't have an account? <a href="{{ route('register') }}" style="color:var(--primary);font-weight:600;text-decoration:none;">Create one free</a></p>

                {{-- Session status --}}
                @if (session('status'))
                    <div class="session-status">
                        <i class="bi bi-check-circle-fill me-1"></i>{{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="you@example.com"
                            required
                            autofocus
                            autocomplete="username"
                        >
                        @error('email')
                            <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label mb-0">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                            @endif
                        </div>
                        <div class="pw-wrapper">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                            >
                            <button type="button" class="pw-toggle" id="pwToggle" aria-label="Toggle password visibility">
                                <i class="bi bi-eye" id="pwIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember me --}}
                    <div class="mb-4">
                        <div class="form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">Keep me signed in</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-submit">
                        Sign in <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>

                @if (Route::has('register'))
                <div class="divider">or</div>
                <p class="register-prompt">
                    New to PhotoShare? <a href="{{ route('register') }}">Create a free account</a>
                </p>
                @endif

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const pwToggle = document.getElementById('pwToggle');
        const pwInput  = document.getElementById('password');
        const pwIcon   = document.getElementById('pwIcon');

        pwToggle.addEventListener('click', () => {
            const visible = pwInput.type === 'text';
            pwInput.type  = visible ? 'password' : 'text';
            pwIcon.className = visible ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    </script>
</body>
</html>
