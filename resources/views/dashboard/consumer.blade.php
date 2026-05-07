<x-app-layout>
    @push('styles')
    <style>
        .feed-shell {
            max-width: 1180px;
        }

        .feed-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 1rem;
            align-items: stretch;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 992px) {
            .feed-hero {
                grid-template-columns: minmax(0, 1.25fr) minmax(300px, 0.75fr);
            }
        }

        .hero-panel,
        .search-panel {
            border: 1px solid rgba(226,232,240,0.9);
            border-radius: 18px;
            background: rgba(255,255,255,0.9);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .hero-panel {
            position: relative;
            padding: clamp(1.5rem, 3vw, 2.3rem);
        }

        .hero-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 18% 14%, rgba(99,102,241,0.2), transparent 17rem),
                radial-gradient(circle at 84% 24%, rgba(236,72,153,0.16), transparent 16rem);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .feed-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            border-radius: 999px;
            background: rgba(99,102,241,0.09);
            color: var(--primary);
            font-size: 0.78rem;
            font-weight: 800;
            padding: 0.38rem 0.75rem;
            margin-bottom: 1rem;
        }

        .hero-panel h1 {
            color: var(--ink);
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 900;
            letter-spacing: -1.2px;
            line-height: 1.04;
            margin: 0;
        }

        .hero-panel p {
            max-width: 640px;
            color: var(--muted);
            margin: 1rem 0 0;
            line-height: 1.7;
        }

        .trend-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
            margin-top: 1.25rem;
        }

        .trend-chip {
            border: 1px solid rgba(99,102,241,0.18);
            border-radius: 999px;
            background: #fff;
            color: #475569;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.42rem 0.72rem;
        }

        .search-panel {
            padding: 1.25rem;
            align-self: stretch;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .search-panel h2 {
            font-size: 1rem;
            font-weight: 850;
            letter-spacing: -0.2px;
            margin-bottom: 0.35rem;
        }

        .search-panel p {
            color: var(--muted);
            font-size: 0.86rem;
            margin-bottom: 1rem;
        }

        .search-box {
            display: flex;
            gap: 0.55rem;
        }

        .search-box .form-control {
            border: 1.5px solid var(--line);
            border-radius: 12px;
            font-size: 0.92rem;
            padding: 0.75rem 0.9rem;
        }

        .search-box .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 1rem;
            margin: 1.5rem 0 1rem;
        }

        .section-title h2 {
            font-size: 1.35rem;
            font-weight: 850;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .section-title span {
            color: var(--muted);
            font-size: 0.88rem;
            font-weight: 600;
        }

        .feed-card {
            height: 100%;
        }

        .creator-line {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin-bottom: 0.9rem;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient);
            color: #fff;
            font-weight: 850;
            box-shadow: 0 8px 18px rgba(99,102,241,0.25);
        }

        .creator-name {
            color: var(--ink);
            font-size: 0.92rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .post-time {
            color: var(--muted);
            font-size: 0.76rem;
            font-weight: 600;
        }

        .feed-photo {
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: var(--dark);
        }

        .feed-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s;
        }

        .feed-card:hover .feed-photo img {
            transform: scale(1.04);
        }

        .location-pill {
            position: absolute;
            left: 0.85rem;
            bottom: 0.85rem;
            max-width: calc(100% - 1.7rem);
            border-radius: 999px;
            background: rgba(15,23,42,0.72);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.35rem 0.7rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            backdrop-filter: blur(10px);
        }

        .post-title {
            color: var(--ink);
            font-size: 1rem;
            font-weight: 850;
            letter-spacing: -0.2px;
            margin-bottom: 0.35rem;
        }

        .post-caption {
            color: var(--muted);
            font-size: 0.86rem;
            line-height: 1.55;
            min-height: 2.6rem;
        }

        .action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--muted);
            font-size: 0.84rem;
            font-weight: 700;
            margin: 1rem 0;
        }

        .action-row i {
            color: var(--primary);
        }

        .empty-panel {
            border: 1px dashed rgba(99,102,241,0.35);
            border-radius: 18px;
            background: rgba(255,255,255,0.78);
            padding: 3rem 1.5rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
        }

        .empty-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 1rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(99,102,241,0.1);
            color: var(--primary);
            font-size: 2rem;
        }

        @media (max-width: 575.98px) {
            .search-box {
                flex-direction: column;
            }
        }
    </style>
    @endpush

    <div class="container feed-shell">
        <section class="feed-hero">
            <div class="hero-panel">
                <div class="hero-content">
                    <span class="feed-kicker"><i class="bi bi-camera-reels-fill"></i> Social photo feed</span>
                    <h1>Discover fresh moments from the PhotoShare community.</h1>
                    <p>Browse creator uploads, find places and people, and open the photos that catch your eye.</p>
                    <div class="trend-list">
                        <span class="trend-chip"><i class="bi bi-stars me-1"></i>New uploads</span>
                        <span class="trend-chip"><i class="bi bi-chat-heart me-1"></i>Community comments</span>
                        <span class="trend-chip"><i class="bi bi-star-fill me-1"></i>Top rated</span>
                    </div>
                </div>
            </div>

            <aside class="search-panel">
                <h2>Search the feed</h2>
                <p>Look up titles, captions, locations, or tagged people.</p>
                <form action="{{ route('photos.search') }}" method="GET">
                    <div class="search-box">
                        <input type="text" name="q" class="form-control" placeholder="Search photos..." value="{{ request('q') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </aside>
        </section>

        <div class="section-title">
            <div>
                <h2>Latest Photos</h2>
                <span>{{ $photos->total() }} posts available</span>
            </div>
        </div>

        @if($photos->count() > 0)
            <div class="row g-4">
                @foreach($photos as $photo)
                    <div class="col-xl-4 col-md-6">
                        <article class="card feed-card">
                            <div class="card-body pb-3">
                                <div class="creator-line">
                                    <span class="avatar">{{ strtoupper(Str::substr($photo->user->name, 0, 1)) }}</span>
                                    <div>
                                        <div class="creator-name">{{ $photo->user->name }}</div>
                                        <div class="post-time">{{ $photo->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="feed-photo">
                                <img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->title }}">
                                @if($photo->location)
                                    <span class="location-pill"><i class="bi bi-geo-alt-fill me-1"></i>{{ $photo->location }}</span>
                                @endif
                            </div>

                            <div class="card-body">
                                <h3 class="post-title">{{ $photo->title }}</h3>
                                <p class="post-caption mb-0">{{ Str::limit($photo->caption ?: 'Open the photo to view details and join the conversation.', 96) }}</p>

                                <div class="action-row">
                                    <span class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= round($photo->avg_rating) ? '-fill' : '' }}"></i>
                                        @endfor
                                    </span>
                                    <span><i class="bi bi-chat-fill me-1"></i>{{ $photo->comments_count }}</span>
                                </div>

                                <a href="{{ route('photos.show', $photo) }}" class="btn btn-primary w-100">
                                    <i class="bi bi-eye me-1"></i>View details
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="mt-5">
                {{ $photos->links() }}
            </div>
        @else
            <div class="empty-panel">
                <div class="empty-icon"><i class="bi bi-images"></i></div>
                <h3 class="fw-bold">No photos available</h3>
                <p class="text-muted mb-0">Check back later for new creator uploads.</p>
            </div>
        @endif
    </div>
</x-app-layout>
