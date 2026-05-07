<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up - PhotoShare</title>

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
            min-height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .auth-wrap {
            display: flex;
            min-height: 100vh;
        }

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
            top: -120px;
            left: -100px;
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, rgba(99,102,241,0.3) 0%, transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        .left-glow-2 {
            position: absolute;
            bottom: -150px;
            right: -80px;
            width: 420px;
            height: 420px;
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
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: rgba(99,102,241,0.15);
            border: 1px solid rgba(99,102,241,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
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
            max-width: 460px;
        }

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
            margin-bottom: 1.75rem;
        }

        .subtitle a,
        .login-prompt a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .subtitle a:hover,
        .login-prompt a:hover {
            text-decoration: underline;
        }

        .form-label {
            font-size: 0.83rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }

        .form-control,
        .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.68rem 0.9rem;
            font-size: 0.92rem;
            color: #0f172a;
            background-color: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
            outline: none;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #ef4444;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
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

        .pw-wrapper .form-control {
            padding-right: 2.75rem;
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

        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.5rem 0;
            color: #cbd5e1;
            font-size: 0.78rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .login-prompt {
            text-align: center;
            font-size: 0.87rem;
            color: #64748b;
            margin: 0;
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
        <div class="auth-left">
            <div class="left-glow-1"></div>
            <div class="left-glow-2"></div>

            <div class="left-brand">
                <img src="{{ asset('logo.png') }}" alt="PhotoShare" class="auth-logo">
            </div>

            <div class="left-content">
                <h2>Start sharing your best moments</h2>
                <p>Create your account to save favorites, join conversations, and publish your own photography.</p>
                <ul class="left-features">
                    <li>
                        <span class="feat-dot"><i class="bi bi-person-plus-fill"></i></span>
                        Choose the account type that fits how you use PhotoShare
                    </li>
                    <li>
                        <span class="feat-dot"><i class="bi bi-cloud-upload-fill"></i></span>
                        Creators can upload and manage a photo portfolio
                    </li>
                    <li>
                        <span class="feat-dot"><i class="bi bi-chat-heart-fill"></i></span>
                        Consumers can discover, rate, and comment on photos
                    </li>
                </ul>
            </div>

            <div class="left-footer">
                <p>&copy; 2026 PhotoShare</p>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-card">
                <a href="/" class="mobile-brand">
                    <img src="{{ asset('logo.png') }}" alt="PhotoShare" class="auth-logo">
                </a>

                <h1>Create account</h1>
                <p class="subtitle">Already registered? <a href="{{ route('login') }}">Sign in instead</a></p>

                <form method="POST" action="{{ route('register') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Your name"
                            required
                            autofocus
                            autocomplete="name"
                        >
                        @error('name')
                            <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

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
                            autocomplete="username"
                        >
                        @error('email')
                            <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Account type</label>
                        <select
                            id="role"
                            name="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required
                        >
                            <option value="consumer" @selected(old('role', 'consumer') === 'consumer')>Consumer - view and comment on photos</option>
                            <option value="creator" @selected(old('role') === 'creator')>Creator - upload photos</option>
                        </select>
                        @error('role')
                            <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="pw-wrapper">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="********"
                                required
                                autocomplete="new-password"
                            >
                            <button type="button" class="pw-toggle" data-target="password" aria-label="Toggle password visibility">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm password</label>
                        <div class="pw-wrapper">
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="********"
                                required
                                autocomplete="new-password"
                            >
                            <button type="button" class="pw-toggle" data-target="password_confirmation" aria-label="Toggle confirm password visibility">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-submit">
                        Create account <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>

                <div class="divider">or</div>
                <p class="login-prompt">
                    Have an account? <a href="{{ route('login') }}">Sign in to PhotoShare</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.pw-toggle').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.target);
                const icon = button.querySelector('i');
                const visible = input.type === 'text';

                input.type = visible ? 'password' : 'text';
                icon.className = visible ? 'bi bi-eye' : 'bi bi-eye-slash';
            });
        });
    </script>
</body>
</html>
