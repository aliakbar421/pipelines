<x-app-layout>
    @push('styles')
    <style>
        .creator-dashboard {
            max-width: 1220px;
        }

        .creator-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 1rem;
            align-items: stretch;
            margin-bottom: 1rem;
        }

        @media (min-width: 992px) {
            .creator-hero {
                grid-template-columns: minmax(0, 1.25fr) minmax(320px, 0.75fr);
            }
        }

        .profile-panel,
        .featured-panel,
        .metric-card,
        .tool-panel,
        .portfolio-card,
        .empty-panel {
            border: 1px solid rgba(226,232,240,0.9);
            border-radius: 18px;
            background: rgba(255,255,255,0.92);
            box-shadow: var(--shadow-sm);
        }

        .profile-panel {
            position: relative;
            overflow: hidden;
            min-height: 320px;
            padding: clamp(1.35rem, 3vw, 2.25rem);
            background:
                linear-gradient(135deg, rgba(11,11,24,0.95), rgba(49,46,129,0.9)),
                var(--dark);
            color: #fff;
        }

        .profile-panel::before,
        .profile-panel::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
        }

        .profile-panel::before {
            width: 460px;
            height: 460px;
            top: -240px;
            right: -140px;
            background: radial-gradient(circle, rgba(236,72,153,0.34), transparent 68%);
        }

        .profile-panel::after {
            width: 380px;
            height: 380px;
            left: -160px;
            bottom: -210px;
            background: radial-gradient(circle, rgba(99,102,241,0.36), transparent 68%);
        }

        .profile-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .creator-id {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .creator-avatar {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient);
            color: #fff;
            font-size: 1.45rem;
            font-weight: 900;
            box-shadow: 0 18px 35px rgba(99,102,241,0.3);
            flex: 0 0 auto;
        }

        .creator-name {
            font-size: 1rem;
            font-weight: 850;
            line-height: 1.1;
        }

        .creator-role {
            color: #cbd5e1;
            font-size: 0.82rem;
            font-weight: 650;
            margin-top: 0.25rem;
        }

        .profile-panel h1 {
            max-width: 720px;
            font-size: clamp(2rem, 4vw, 3.35rem);
            font-weight: 900;
            letter-spacing: -1.3px;
            line-height: 1.03;
            margin: 0;
        }

        .profile-panel p {
            max-width: 650px;
            color: #cbd5e1;
            line-height: 1.7;
            margin: 1rem 0 0;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.7rem;
            margin-top: auto;
            padding-top: 1.5rem;
        }

        .hero-secondary {
            border: 1px solid rgba(255,255,255,0.18);
            background: rgba(255,255,255,0.09);
            color: #fff;
            border-radius: 10px;
            font-weight: 750;
            padding: 0.62rem 1.05rem;
            text-decoration: none;
        }

        .hero-secondary:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        .featured-panel {
            overflow: hidden;
            min-height: 320px;
            display: flex;
            flex-direction: column;
        }

        .featured-image {
            position: relative;
            aspect-ratio: 4 / 3;
            background: var(--dark);
            overflow: hidden;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .featured-label {
            position: absolute;
            left: 0.85rem;
            top: 0.85rem;
            border-radius: 999px;
            background: rgba(15,23,42,0.76);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.35rem 0.7rem;
            backdrop-filter: blur(10px);
        }

        .featured-body {
            padding: 1rem;
        }

        .featured-body h2 {
            color: var(--ink);
            font-size: 1.05rem;
            font-weight: 900;
            letter-spacing: -0.25px;
            margin: 0 0 0.45rem;
        }

        .featured-body p {
            color: var(--muted);
            font-size: 0.86rem;
            line-height: 1.55;
            margin: 0;
        }

        .featured-empty {
            display: flex;
            flex: 1;
            align-items: center;
            justify-content: center;
            min-height: 320px;
            padding: 1.5rem;
            text-align: center;
            background:
                radial-gradient(circle at top, rgba(99,102,241,0.12), transparent 16rem),
                #fff;
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        @media (min-width: 992px) {
            .metric-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .metric-card {
            padding: 1rem;
        }

        .metric-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.8rem;
        }

        .metric-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(99,102,241,0.1);
            color: var(--primary);
            font-size: 1.15rem;
        }

        .metric-chip {
            border-radius: 999px;
            background: rgba(15,23,42,0.04);
            color: var(--muted);
            font-size: 0.72rem;
            font-weight: 800;
            padding: 0.28rem 0.55rem;
        }

        .metric-value {
            display: block;
            color: var(--ink);
            font-size: 1.65rem;
            font-weight: 900;
            line-height: 1;
            margin-top: 1rem;
        }

        .metric-label {
            color: var(--muted);
            font-size: 0.82rem;
            font-weight: 700;
            margin-top: 0.3rem;
        }

        .creator-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 1rem;
            align-items: start;
        }

        @media (min-width: 992px) {
            .creator-layout {
                grid-template-columns: 260px minmax(0, 1fr);
            }
        }

        .tool-panel {
            padding: 1rem;
            position: sticky;
            top: 92px;
        }

        .tool-panel h2,
        .section-heading h2 {
            color: var(--ink);
            font-size: 1.08rem;
            font-weight: 900;
            letter-spacing: -0.3px;
            margin: 0;
        }

        .tool-panel p {
            color: var(--muted);
            font-size: 0.84rem;
            line-height: 1.55;
            margin: 0.4rem 0 1rem;
        }

        .tool-link {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            border: 1px solid rgba(226,232,240,0.9);
            border-radius: 12px;
            color: #334155;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 800;
            padding: 0.75rem;
            margin-top: 0.6rem;
            transition: border-color 0.2s, background 0.2s, color 0.2s;
        }

        .tool-link i {
            color: var(--primary);
        }

        .tool-link:hover {
            border-color: rgba(99,102,241,0.28);
            background: rgba(99,102,241,0.07);
            color: var(--primary);
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .section-heading span {
            color: var(--muted);
            font-size: 0.86rem;
            font-weight: 700;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .portfolio-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 1200px) {
            .portfolio-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .portfolio-card {
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
        }

        .portfolio-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(99,102,241,0.24);
        }

        .photo-frame {
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: var(--dark);
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s;
        }

        .portfolio-card:hover .photo-frame img {
            transform: scale(1.045);
        }

        .photo-chip,
        .quality-chip {
            position: absolute;
            border-radius: 999px;
            background: rgba(15,23,42,0.74);
            color: #fff;
            font-size: 0.74rem;
            font-weight: 800;
            padding: 0.35rem 0.65rem;
            backdrop-filter: blur(10px);
        }

        .photo-chip {
            left: 0.75rem;
            top: 0.75rem;
        }

        .quality-chip {
            right: 0.75rem;
            top: 0.75rem;
        }

        .portfolio-body {
            padding: 1rem;
        }

        .portfolio-title {
            color: var(--ink);
            font-size: 1rem;
            font-weight: 900;
            letter-spacing: -0.2px;
            margin: 0;
        }

        .portfolio-caption {
            color: var(--muted);
            font-size: 0.84rem;
            line-height: 1.55;
            min-height: 2.6rem;
            margin: 0.45rem 0 0.9rem;
        }

        .portfolio-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
            margin-bottom: 0.9rem;
        }

        .meta-pill {
            border-radius: 999px;
            background: rgba(99,102,241,0.08);
            color: #475569;
            font-size: 0.74rem;
            font-weight: 750;
            padding: 0.32rem 0.58rem;
        }

        .engagement-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(226,232,240,0.85);
            padding-top: 0.85rem;
            margin-bottom: 0.9rem;
            color: var(--muted);
            font-size: 0.83rem;
            font-weight: 800;
        }

        .card-actions {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto auto;
            gap: 0.5rem;
        }

        .empty-panel {
            padding: 3rem 1.5rem;
            text-align: center;
            border-style: dashed;
            background:
                radial-gradient(circle at top, rgba(99,102,241,0.12), transparent 18rem),
                rgba(255,255,255,0.86);
        }

        .empty-icon {
            width: 74px;
            height: 74px;
            margin: 0 auto 1rem;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(99,102,241,0.1);
            color: var(--primary);
            font-size: 2rem;
        }

        @media (max-width: 575.98px) {
            .metric-grid {
                grid-template-columns: 1fr;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .tool-panel {
                position: static;
            }
        }
    </style>
    @endpush

    <div class="container creator-dashboard">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <section class="creator-hero">
            <div class="profile-panel">
                <div class="profile-content">
                    <div class="creator-id">
                        <span class="creator-avatar">{{ strtoupper(Str::substr(auth()->user()->name, 0, 1)) }}</span>
                        <div>
                            <div class="creator-name">{{ auth()->user()->name }}</div>
                            <div class="creator-role"><i class="bi bi-patch-check-fill me-1"></i>Creator studio</div>
                        </div>
                    </div>

                    <h1>Manage your portfolio, audience, and photo stories in one place.</h1>
                    <p>Your dashboard is built for publishing, tracking feedback, and keeping your best images easy to manage.</p>

                    <div class="hero-actions">
                        <a href="{{ route('photos.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>Upload new photo
                        </a>
                        <a href="{{ route('photos.search') }}" class="hero-secondary">
                            <i class="bi bi-compass me-1"></i>Explore community
                        </a>
                    </div>
                </div>
            </div>

            <aside class="featured-panel">
                @if($featuredPhoto)
                    <div class="featured-image">
                        <img src="{{ Storage::url($featuredPhoto->image_path) }}" alt="{{ $featuredPhoto->title }}">
                        <span class="featured-label"><i class="bi bi-trophy-fill me-1"></i>Top portfolio photo</span>
                    </div>
                    <div class="featured-body">
                        <h2>{{ $featuredPhoto->title }}</h2>
                        <p>{{ Str::limit($featuredPhoto->caption ?: 'This photo is leading your portfolio based on rating activity.', 96) }}</p>
                        <div class="engagement-row mb-0 mt-3">
                            <span><i class="bi bi-star-fill text-warning me-1"></i>{{ number_format($featuredPhoto->avg_rating, 1) }} rating</span>
                            <span><i class="bi bi-chat-fill me-1"></i>{{ $featuredPhoto->comments_count }}</span>
                        </div>
                    </div>
                @else
                    <div class="featured-empty">
                        <div>
                            <div class="empty-icon"><i class="bi bi-image"></i></div>
                            <h2 class="fw-bold h5">No featured photo yet</h2>
                            <p class="text-muted mb-0">Upload your first image to start building your portfolio.</p>
                        </div>
                    </div>
                @endif
            </aside>
        </section>

        <section class="metric-grid" aria-label="Creator statistics">
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-icon"><i class="bi bi-images"></i></span>
                    <span class="metric-chip">All time</span>
                </div>
                <span class="metric-value">{{ $creatorStats['photos'] }}</span>
                <div class="metric-label">Published photos</div>
            </div>
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-icon"><i class="bi bi-chat-heart"></i></span>
                    <span class="metric-chip">Audience</span>
                </div>
                <span class="metric-value">{{ $creatorStats['comments'] }}</span>
                <div class="metric-label">Total comments</div>
            </div>
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-icon"><i class="bi bi-star-fill"></i></span>
                    <span class="metric-chip">Feedback</span>
                </div>
                <span class="metric-value">{{ $creatorStats['ratings'] }}</span>
                <div class="metric-label">Total ratings</div>
            </div>
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-icon"><i class="bi bi-graph-up-arrow"></i></span>
                    <span class="metric-chip">Quality</span>
                </div>
                <span class="metric-value">{{ number_format($creatorStats['avg_rating'], 1) }}</span>
                <div class="metric-label">Average portfolio rating</div>
            </div>
        </section>

        <div class="creator-layout">
            <aside class="tool-panel">
                <h2>Creator tools</h2>
                <p>Quick actions for publishing, reviewing, and improving your PhotoShare presence.</p>
                <a href="{{ route('photos.create') }}" class="tool-link">
                    <i class="bi bi-cloud-upload-fill"></i>Upload content
                </a>
                <a href="{{ route('photos.search') }}" class="tool-link">
                    <i class="bi bi-search-heart"></i>View public feed
                </a>
                <a href="{{ route('profile.edit') }}" class="tool-link">
                    <i class="bi bi-person-gear"></i>Edit profile
                </a>
            </aside>

            <section>
                <div class="section-heading">
                    <div>
                        <h2>Portfolio manager</h2>
                        <span>{{ $photos->total() }} uploads sorted by newest first</span>
                    </div>
                    <a href="{{ route('photos.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>New upload
                    </a>
                </div>

                @if($photos->count() > 0)
                    <div class="portfolio-grid">
                        @foreach($photos as $photo)
                            <article class="portfolio-card">
                                <div class="photo-frame">
                                    <img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->title }}">
                                    <span class="photo-chip"><i class="bi bi-calendar3 me-1"></i>{{ $photo->created_at->diffForHumans() }}</span>
                                    <span class="quality-chip"><i class="bi bi-star-fill me-1"></i>{{ number_format($photo->avg_rating, 1) }}</span>
                                </div>

                                <div class="portfolio-body">
                                    <h3 class="portfolio-title">{{ $photo->title }}</h3>
                                    <p class="portfolio-caption">{{ Str::limit($photo->caption ?: 'No caption added yet. Add context to help viewers connect with this photo.', 92) }}</p>

                                    <div class="portfolio-meta">
                                        @if($photo->location)
                                            <span class="meta-pill"><i class="bi bi-geo-alt-fill me-1"></i>{{ Str::limit($photo->location, 22) }}</span>
                                        @endif
                                        @if($photo->people)
                                            <span class="meta-pill"><i class="bi bi-people-fill me-1"></i>{{ Str::limit($photo->people, 24) }}</span>
                                        @endif
                                        @if(!$photo->location && !$photo->people)
                                            <span class="meta-pill"><i class="bi bi-tag-fill me-1"></i>Add metadata</span>
                                        @endif
                                    </div>

                                    <div class="engagement-row">
                                        <span><i class="bi bi-star-fill text-warning me-1"></i>{{ $photo->ratings_count }} {{ Str::plural('rating', $photo->ratings_count) }}</span>
                                        <span><i class="bi bi-chat-fill me-1"></i>{{ $photo->comments_count }}</span>
                                    </div>

                                    <div class="card-actions">
                                        <a href="{{ route('photos.show', $photo) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye me-1"></i>Open
                                        </a>
                                        <a href="{{ route('photos.edit', $photo) }}" class="btn btn-sm btn-outline-secondary" aria-label="Edit {{ $photo->title }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Delete {{ $photo->title }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-5">
                        {{ $photos->links() }}
                    </div>
                @else
                    <div class="empty-panel">
                        <div class="empty-icon"><i class="bi bi-cloud-upload"></i></div>
                        <h3 class="fw-bold">Start your creator portfolio</h3>
                        <p class="text-muted mb-4">Upload a first photo with a title, caption, location, and tagged people so the community can discover it.</p>
                        <a href="{{ route('photos.create') }}" class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i>Upload your first photo
                        </a>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
