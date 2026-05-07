<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PhotoShare') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #6366f1;
            --dark: #0b0b18;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --surface: #ffffff;
            --soft: #f8fafc;
            --gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            --primary-gradient: var(--gradient);
            --secondary-gradient: linear-gradient(135deg, #ec4899 0%, #f97316 100%);
            --success-gradient: linear-gradient(135deg, #06b6d4 0%, #22c55e 100%);
            --shadow-sm: 0 8px 28px rgba(15, 23, 42, 0.08);
            --shadow-md: 0 18px 45px rgba(15, 23, 42, 0.13);
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(99,102,241,0.13), transparent 34rem),
                radial-gradient(circle at top right, rgba(236,72,153,0.11), transparent 30rem),
                #f8fafc;
            min-height: 100vh;
            color: var(--ink);
        }

        .navbar-brand {
            display: inline-flex;
            align-items: center;
            padding: 0;
        }

        .site-logo {
            display: block;
            width: auto;
            height: 104px;
            max-width: 430px;
            object-fit: contain;
        }

        @media (max-width: 575.98px) {
            .site-logo {
                height: 78px;
                max-width: 290px;
            }
        }

        .btn-primary {
            background: var(--gradient);
            border: none;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.58rem 1.2rem;
            box-shadow: 0 7px 22px rgba(99,102,241,0.28);
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 11px 30px rgba(99,102,241,0.38);
            opacity: 0.95;
        }

        .btn-outline-primary {
            border-color: rgba(99,102,241,0.35);
            color: var(--primary);
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .btn-outline-secondary,
        .btn-outline-danger {
            border-radius: 10px;
            font-weight: 600;
        }

        .card {
            border: 1px solid rgba(226,232,240,0.9);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(99,102,241,0.22);
        }

        .photo-card-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
            background: #0b0b18;
        }

        .badge {
            font-weight: 600;
            padding: 0.5em 1em;
        }

        .badge-creator {
            background: var(--gradient);
        }

        .badge-consumer {
            background: var(--success-gradient);
        }

        .alert {
            border-radius: 12px;
            border: 1px solid transparent;
        }

        .navbar {
            background: rgba(255,255,255,0.88);
            border-bottom: 1px solid rgba(226,232,240,0.8);
            box-shadow: 0 8px 30px rgba(15,23,42,0.05);
            backdrop-filter: blur(16px);
        }

        .nav-link {
            color: #475569;
            font-weight: 600;
            font-size: 0.92rem;
            border-radius: 10px;
            padding: 0.55rem 0.8rem !important;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: var(--primary);
            background: rgba(99,102,241,0.08);
        }

        .star-rating {
            color: #f59e0b;
            font-size: 1.05rem;
        }

        .star-rating-clickable i {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .star-rating-clickable i:hover {
            transform: scale(1.3);
        }

        .dropdown-menu {
            border: 1px solid rgba(226,232,240,0.9);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            padding: 0.55rem;
        }

        .dropdown-item {
            border-radius: 9px;
            color: #334155;
            font-weight: 500;
            padding: 0.55rem 0.75rem;
        }

        .dropdown-item:hover {
            color: var(--primary);
            background: rgba(99,102,241,0.08);
        }

        main {
            position: relative;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('logo.png') }}" alt="PhotoShare" class="site-logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-fill"></i> Home
                        </a>
                    </li>
                    
                    @auth
                        @if(auth()->user()->isCreator())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('photos.create') }}">
                                <i class="bi bi-upload"></i> Upload
                            </a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('photos.search') }}">
                                <i class="bi bi-search"></i> Search
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                <span class="badge badge-{{ auth()->user()->isCreator() ? 'creator' : 'consumer' }} ms-2">
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-4">
        {{ $slot }}
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
