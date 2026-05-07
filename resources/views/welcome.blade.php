<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhotoShare - Share Your Moments</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #a855f7;
            --accent: #ec4899;
            --dark: #0b0b18;
            --dark-card: #13131f;
            --dark-border: rgba(255,255,255,0.07);
            --gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            --gradient-soft: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(168,85,247,0.1) 100%);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* ── Navbar ───────────────────────────────── */
        #mainNav {
            padding: 1.1rem 0;
            transition: background 0.35s ease, padding 0.35s ease, box-shadow 0.35s ease;
        }

        #mainNav.scrolled {
            background: rgba(255,255,255,0.96) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 24px rgba(0,0,0,0.07);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            display: inline-flex;
            align-items: center;
            padding: 0;
        }

        .site-logo {
            display: block;
            width: auto;
            height: 108px;
            max-width: 440px;
            object-fit: contain;
        }

        .footer-logo {
            display: block;
            width: auto;
            height: 88px;
            max-width: 360px;
            object-fit: contain;
        }

        @media (max-width: 575.98px) {
            .site-logo {
                height: 78px;
                max-width: 290px;
            }

            .footer-logo {
                height: 68px;
                max-width: 270px;
            }
        }

        .nav-link-light {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 500;
            padding: 0.45rem 0.9rem !important;
            border-radius: 8px;
            transition: color 0.2s, background 0.2s;
        }
        .nav-link-light:hover { color: #fff !important; background: rgba(255,255,255,0.07); }

        #mainNav.scrolled .nav-link-light { color: #475569 !important; }
        #mainNav.scrolled .nav-link-light:hover { color: var(--primary) !important; background: rgba(99,102,241,0.06); }

        .btn-nav-outline {
            color: rgba(255,255,255,0.9) !important;
            border: 1.5px solid rgba(255,255,255,0.3);
            border-radius: 50px;
            padding: 0.42rem 1.2rem;
            font-weight: 600;
            font-size: 0.88rem;
            transition: all 0.25s;
            background: transparent;
        }
        .btn-nav-outline:hover { background: rgba(255,255,255,0.12); color: #fff !important; }

        #mainNav.scrolled .btn-nav-outline {
            color: var(--primary) !important;
            border-color: var(--primary);
        }
        #mainNav.scrolled .btn-nav-outline:hover { background: var(--primary); color: #fff !important; }

        .btn-nav-solid {
            background: var(--gradient);
            color: #fff !important;
            border-radius: 50px;
            padding: 0.42rem 1.2rem;
            font-weight: 600;
            font-size: 0.88rem;
            border: none;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(99,102,241,0.35);
        }
        .btn-nav-solid:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(99,102,241,0.45); }

        .navbar-toggler { border: none; padding: 0.25rem 0.5rem; }
        .navbar-toggler:focus { box-shadow: none; }

        /* ── Hero ─────────────────────────────────── */
        .hero-section {
            min-height: 100vh;
            background: var(--dark);
            position: relative;
            display: flex;
            align-items: center;
            padding: 7rem 0 5rem;
            overflow: hidden;
        }

        .hero-glow-1 {
            position: absolute;
            top: -180px; left: -150px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99,102,241,0.28) 0%, transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-glow-2 {
            position: absolute;
            bottom: -200px; right: -100px;
            width: 550px; height: 550px;
            background: radial-gradient(circle, rgba(168,85,247,0.22) 0%, transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.28);
            color: #a5b4fc;
            padding: 0.38rem 1rem;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        .glow-dot {
            width: 7px; height: 7px;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 8px #22c55e;
            animation: blink 2s ease-in-out infinite;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.35} }

        .hero-title {
            font-size: clamp(2.6rem, 6vw, 4.8rem);
            font-weight: 900;
            line-height: 1.08;
            letter-spacing: -2.5px;
            color: #fff;
            margin-bottom: 1.4rem;
        }

        .gradient-text {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-lead {
            font-size: 1.1rem;
            color: #94a3b8;
            line-height: 1.75;
            max-width: 500px;
            margin-bottom: 2rem;
        }

        .hero-trust {
            font-size: 0.8rem;
            color: #475569;
            margin-top: 1rem;
        }
        .hero-trust i { color: #22c55e; }

        /* ── Hero CTA buttons ─────────────────────── */
        .btn-primary-grad {
            background: var(--gradient);
            color: #fff;
            border: none;
            padding: 0.82rem 1.9rem;
            font-size: 0.97rem;
            font-weight: 600;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.28s;
            box-shadow: 0 8px 28px rgba(99,102,241,0.38);
        }
        .btn-primary-grad:hover { transform: translateY(-3px); box-shadow: 0 12px 36px rgba(99,102,241,0.5); color: #fff; }

        .btn-ghost-white {
            background: rgba(255,255,255,0.07);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.18);
            padding: 0.82rem 1.9rem;
            font-size: 0.97rem;
            font-weight: 600;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            backdrop-filter: blur(10px);
            transition: all 0.28s;
        }
        .btn-ghost-white:hover { background: rgba(255,255,255,0.14); color: #fff; transform: translateY(-3px); }

        /* ── Photo grid mockup ────────────────────── */
        .photo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            max-width: 420px;
            margin: 0 auto;
            transform: perspective(900px) rotateY(-9deg) rotateX(5deg);
            animation: floatGrid 7s ease-in-out infinite;
        }

        @keyframes floatGrid {
            0%,100% { transform: perspective(900px) rotateY(-9deg) rotateX(5deg) translateY(0); }
            50%      { transform: perspective(900px) rotateY(-9deg) rotateX(5deg) translateY(-14px); }
        }

        .pic-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 16px;
            overflow: hidden;
        }

        .pic-card-img {
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.6rem;
        }
        .pic-card.tall .pic-card-img { height: 196px; }

        .pic-card-body {
            padding: 9px 12px 11px;
        }
        .pic-card-title { font-size: 0.78rem; font-weight: 600; color: #e2e8f0; margin-bottom: 3px; }
        .pic-card-meta  { font-size: 0.68rem; color: #475569; }
        .pic-card-meta .like { color: #ec4899; }
        .pic-card-meta .star { color: #f59e0b; }

        /* ── Stats bar ────────────────────────────── */
        .stats-bar {
            background: #fff;
            border-top: 1px solid #f1f5f9;
            padding: 2.8rem 0;
        }

        .stat-item { text-align: center; }

        .stat-num {
            font-size: 2.3rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }

        .stat-lbl {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
            margin-top: 0.3rem;
        }

        .divider-glow {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99,102,241,0.45), transparent);
        }

        /* ── Features ─────────────────────────────── */
        .features-section {
            background: #f8fafc;
            padding: 6.5rem 0;
        }

        .section-tag {
            display: inline-block;
            background: var(--gradient-soft);
            border: 1px solid rgba(99,102,241,0.2);
            color: var(--primary);
            font-size: 0.76rem;
            font-weight: 700;
            padding: 0.3rem 0.9rem;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 0.8rem;
        }

        .section-title {
            font-size: clamp(1.75rem, 4vw, 2.75rem);
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -1.2px;
            line-height: 1.2;
        }

        .section-sub {
            color: #64748b;
            font-size: 1.05rem;
            max-width: 520px;
            margin: 0.9rem auto 0;
        }

        .feat-card {
            background: #fff;
            border-radius: 20px;
            padding: 1.9rem;
            border: 1px solid #e2e8f0;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
        }

        .feat-card::after {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            background: var(--gradient);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s;
        }

        .feat-card:hover { transform: translateY(-8px); box-shadow: 0 20px 48px rgba(0,0,0,0.07); border-color: transparent; }
        .feat-card:hover::after { transform: scaleX(1); }

        .feat-icon {
            width: 58px; height: 58px;
            border-radius: 15px;
            background: var(--gradient-soft);
            border: 1px solid rgba(99,102,241,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.15rem;
        }
        .feat-icon i {
            font-size: 1.55rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feat-card h5 { font-size: 1.08rem; font-weight: 700; color: #0f172a; margin-bottom: 0.65rem; }
        .feat-card p  { color: #64748b; font-size: 0.92rem; line-height: 1.65; margin: 0; }

        /* ── How it works ─────────────────────────── */
        .how-section {
            background: #fff;
            padding: 6.5rem 0;
        }

        .step-num {
            width: 48px; height: 48px;
            border-radius: 50%;
            background: var(--gradient);
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 6px 18px rgba(99,102,241,0.3);
        }

        .step-item h5 { font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem; }
        .step-item p  { color: #64748b; font-size: 0.88rem; line-height: 1.65; }

        .step-connector {
            position: absolute;
            top: 24px;
            left: calc(50% + 40px);
            width: calc(100% - 80px);
            height: 2px;
            background: linear-gradient(90deg, rgba(99,102,241,0.4), rgba(168,85,247,0.4));
        }

        /* ── CTA ──────────────────────────────────── */
        .cta-section {
            background: var(--dark);
            padding: 7rem 0;
            position: relative;
            overflow: hidden;
        }

        .cta-glow {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%,-50%);
            width: 900px; height: 500px;
            background: radial-gradient(ellipse, rgba(99,102,241,0.18) 0%, transparent 65%);
            pointer-events: none;
        }

        .cta-section h2 {
            font-size: clamp(1.85rem, 4.5vw, 3rem);
            font-weight: 900;
            color: #fff;
            letter-spacing: -1.5px;
        }
        .cta-section p { color: #94a3b8; font-size: 1.05rem; }

        /* ── Footer ───────────────────────────────── */
        footer {
            background: var(--dark);
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 2rem 0;
        }

        .footer-brand {
            font-size: 1.15rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        footer .copy { color: #334155; font-size: 0.83rem; margin: 0; }

        footer .foot-links a {
            color: #334155;
            text-decoration: none;
            font-size: 0.83rem;
            transition: color 0.2s;
        }
        footer .foot-links a:hover { color: #a5b4fc; }

        /* ── Responsive ───────────────────────────── */
        @media (max-width: 991.98px) {
            .photo-grid {
                max-width: 320px;
                transform: none;
                animation: none;
                margin-top: 3rem;
            }
            .hero-section { text-align: center; }
            .hero-lead { margin-left: auto; margin-right: auto; }
            .btn-grp { justify-content: center; }
        }

        @media (max-width: 575.98px) {
            .photo-grid { max-width: 280px; gap: 8px; }
            .pic-card-img { height: 120px; font-size: 2rem; }
            .pic-card.tall .pic-card-img { height: 158px; }
        }
    </style>
</head>
<body>

    <!-- ── Navbar ─────────────────────────────────── -->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNav" style="background:transparent;">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('logo.png') }}" alt="PhotoShare" class="site-logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list fs-4" style="color:rgba(255,255,255,0.85);"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a href="#features" class="nav-link nav-link-light">Features</a>
                    </li>
                    <li class="nav-item">
                        <a href="#how-it-works" class="nav-link nav-link-light">How it works</a>
                    </li>
                    @auth
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-nav-solid">
                            <i class="bi bi-house-fill me-1"></i>Dashboard
                        </a>
                    </li>
                    @else
                    <li class="nav-item ms-lg-1">
                        <a href="{{ route('login') }}" class="btn btn-nav-outline">Sign In</a>
                    </li>
                    <li class="nav-item ms-lg-1">
                        <a href="{{ route('register') }}" class="btn btn-nav-solid">Get Started</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- ── Hero ───────────────────────────────────── -->
    <section class="hero-section">
        <div class="hero-glow-1"></div>
        <div class="hero-glow-2"></div>

        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">

                <!-- Left: copy -->
                <div class="col-lg-6">
                    <div class="hero-badge">
                        <span class="glow-dot"></span>
                        Now live — Join thousands of creators
                    </div>

                    <h1 class="hero-title">
                        Share Photos,<br>
                        <span class="gradient-text">Inspire the World</span>
                    </h1>

                    <p class="hero-lead">
                        Upload your best shots, discover incredible photography from creators worldwide, and build a community around your passion.
                    </p>

                    <div class="d-flex flex-wrap gap-3 btn-grp">
                        @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary-grad">
                            <i class="bi bi-house-fill"></i> Go to Dashboard
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="btn-primary-grad">
                            <i class="bi bi-person-plus-fill"></i> Start for Free
                        </a>
                        <a href="{{ route('login') }}" class="btn-ghost-white">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In
                        </a>
                        @endauth
                    </div>

                    <p class="hero-trust mt-3">
                        <i class="bi bi-shield-check me-1"></i>
                        No credit card required &nbsp;&bull;&nbsp; Free forever plan
                    </p>
                </div>

                <!-- Right: photo grid mockup -->
                <div class="col-lg-6 d-flex justify-content-center">
                    <div class="photo-grid">
                        <div class="pic-card">
                            <div class="pic-card-img" style="background:linear-gradient(135deg,#1e293b,#334155);">🌄</div>
                            <div class="pic-card-body">
                                <div class="pic-card-title">Mountain Sunrise</div>
                                <div class="pic-card-meta">
                                    <i class="bi bi-heart-fill like"></i> 124
                                    &nbsp;
                                    <i class="bi bi-geo-alt"></i> Alps
                                </div>
                            </div>
                        </div>
                        <div class="pic-card tall">
                            <div class="pic-card-img" style="background:linear-gradient(135deg,#1e1b4b,#312e81);">🌃</div>
                            <div class="pic-card-body">
                                <div class="pic-card-title">City Nights</div>
                                <div class="pic-card-meta">
                                    <i class="bi bi-heart-fill like"></i> 256
                                    &nbsp;
                                    <i class="bi bi-star-fill star"></i> 4.9
                                </div>
                            </div>
                        </div>
                        <div class="pic-card">
                            <div class="pic-card-img" style="background:linear-gradient(135deg,#064e3b,#065f46);">🌊</div>
                            <div class="pic-card-body">
                                <div class="pic-card-title">Ocean Waves</div>
                                <div class="pic-card-meta">
                                    <i class="bi bi-heart-fill like"></i> 89
                                    &nbsp;
                                    <i class="bi bi-geo-alt"></i> Pacific
                                </div>
                            </div>
                        </div>
                        <div class="pic-card">
                            <div class="pic-card-img" style="background:linear-gradient(135deg,#451a03,#78350f);">🌸</div>
                            <div class="pic-card-body">
                                <div class="pic-card-title">Spring Bloom</div>
                                <div class="pic-card-meta">
                                    <i class="bi bi-heart-fill like"></i> 203
                                    &nbsp;
                                    <i class="bi bi-star-fill star"></i> 4.7
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── Stats bar ──────────────────────────────── -->
    <div class="stats-bar">
        <div class="container">
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-num">10K+</div>
                        <div class="stat-lbl">Photos Shared</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-num">2.5K+</div>
                        <div class="stat-lbl">Active Creators</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-num">50K+</div>
                        <div class="stat-lbl">Community Members</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-num">4.9★</div>
                        <div class="stat-lbl">Avg. Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="divider-glow"></div>

    <!-- ── Features ───────────────────────────────── -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-tag">Features</span>
                <h2 class="section-title mt-2">
                    Everything you need to share<br>your visual story
                </h2>
                <p class="section-sub">
                    Powerful tools for creators, beautiful experience for viewers — all in one platform.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-sm-6 col-lg-4">
                    <div class="feat-card">
                        <div class="feat-icon"><i class="bi bi-cloud-upload-fill"></i></div>
                        <h5>Smart Upload</h5>
                        <p>Upload photos with rich metadata — title, caption, location tags, and custom categories to maximize discoverability.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="feat-card">
                        <div class="feat-icon"><i class="bi bi-search-heart"></i></div>
                        <h5>Discover &amp; Explore</h5>
                        <p>Search by tag, location, or style. Find photography that moves you across our growing global library.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="feat-card">
                        <div class="feat-icon"><i class="bi bi-chat-heart-fill"></i></div>
                        <h5>Community Engagement</h5>
                        <p>Comment, rate, and connect with photographers who share your passion. Build meaningful creative relationships.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="feat-card">
                        <div class="feat-icon"><i class="bi bi-person-badge-fill"></i></div>
                        <h5>Creator Profiles</h5>
                        <p>Showcase your portfolio with a dedicated profile. Let your work speak for itself with a beautiful gallery layout.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="feat-card">
                        <div class="feat-icon"><i class="bi bi-star-fill"></i></div>
                        <h5>Star Ratings</h5>
                        <p>Get feedback through a 5-star system. Track your top-performing photos and grow as a creator over time.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="feat-card">
                        <div class="feat-icon"><i class="bi bi-shield-check-fill"></i></div>
                        <h5>Safe &amp; Secure</h5>
                        <p>Your photos are protected. Role-based access ensures only you can edit or delete your own content.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── How it works ────────────────────────────── -->
    <section class="how-section" id="how-it-works">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-tag">How it works</span>
                <h2 class="section-title mt-2">Get started in minutes</h2>
                <p class="section-sub">No complicated setup. Just sign up and start sharing.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4 col-lg-3">
                    <div class="step-item text-center">
                        <div class="step-num">1</div>
                        <h5>Create an Account</h5>
                        <p>Sign up in seconds — choose Creator or Consumer based on how you want to participate.</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="step-item text-center">
                        <div class="step-num">2</div>
                        <h5>Upload Your Photos</h5>
                        <p>Creators upload photos with rich metadata. Add titles, captions, locations, and tags for discoverability.</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="step-item text-center">
                        <div class="step-num">3</div>
                        <h5>Engage &amp; Grow</h5>
                        <p>Collect ratings and comments on your work. Discover great photos and build your community.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA ────────────────────────────────────── -->
    <section class="cta-section">
        <div class="cta-glow"></div>
        <div class="container text-center position-relative" style="z-index:2;">
            <span class="section-tag" style="background:rgba(99,102,241,0.12);border-color:rgba(99,102,241,0.28);color:#a5b4fc;">
                Start Today
            </span>
            <h2 class="mt-3 mb-3">Ready to share your moments?</h2>
            <p class="mb-5">Join our community of passionate photographers and visual storytellers.</p>

            @guest
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn-primary-grad" style="font-size:1rem;padding:0.9rem 2.2rem;">
                    <i class="bi bi-person-plus-fill"></i> Create Free Account
                </a>
                <a href="{{ route('login') }}" class="btn-ghost-white" style="font-size:1rem;padding:0.9rem 2.2rem;">
                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                </a>
            </div>
            @endguest

            @auth
            <a href="{{ route('dashboard') }}" class="btn-primary-grad" style="font-size:1rem;padding:0.9rem 2.2rem;">
                <i class="bi bi-house-fill"></i> Go to Dashboard
            </a>
            @endauth
        </div>
    </section>

    <!-- ── Footer ─────────────────────────────────── -->
    <footer>
        <div class="container">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                <span class="footer-brand">
                    <img src="{{ asset('logo.png') }}" alt="PhotoShare" class="footer-logo">
                </span>
                <p class="copy">&copy; 2026 PhotoShare. Built with Laravel &amp; Bootstrap.</p>
                <div class="foot-links d-flex gap-4">
                    <a href="#">Privacy</a>
                    <a href="#">Terms</a>
                    <a href="#">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        const nav = document.getElementById('mainNav');
        const toggler = nav.querySelector('.bi-list');

        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 60);
            toggler.style.color = window.scrollY > 60 ? '#475569' : 'rgba(255,255,255,0.85)';
        });

        // Smooth anchor scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const t = document.querySelector(a.getAttribute('href'));
                if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
            });
        });
    </script>
</body>
</html>
