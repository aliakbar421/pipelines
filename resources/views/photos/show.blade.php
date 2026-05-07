<x-app-layout>
    @push('styles')
    <style>
        .photo-detail-shell {
            max-width: 1180px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 1.25rem;
        }

        @media (min-width: 992px) {
            .detail-grid {
                grid-template-columns: minmax(0, 1.45fr) minmax(320px, 0.75fr);
                align-items: start;
            }
        }

        .post-panel,
        .side-panel,
        .comments-panel {
            border: 1px solid rgba(226,232,240,0.9);
            border-radius: 18px;
            background: rgba(255,255,255,0.92);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.1rem;
            border-bottom: 1px solid rgba(226,232,240,0.85);
        }

        .creator-wrap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 0;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient);
            color: #fff;
            font-weight: 900;
            box-shadow: 0 10px 22px rgba(99,102,241,0.28);
            flex: 0 0 auto;
        }

        .creator-name {
            color: var(--ink);
            font-size: 0.98rem;
            font-weight: 850;
            line-height: 1.1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .post-meta {
            color: var(--muted);
            font-size: 0.78rem;
            font-weight: 650;
            margin-top: 0.2rem;
        }

        .owner-actions {
            display: flex;
            gap: 0.5rem;
            flex: 0 0 auto;
        }

        .photo-stage {
            position: relative;
            background:
                radial-gradient(circle at 20% 15%, rgba(99,102,241,0.18), transparent 18rem),
                radial-gradient(circle at 80% 85%, rgba(236,72,153,0.18), transparent 18rem),
                #0b0b18;
            min-height: 360px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .photo-stage img {
            display: block;
            width: 100%;
            max-height: 720px;
            object-fit: contain;
        }

        .photo-overlay-chip {
            position: absolute;
            left: 1rem;
            bottom: 1rem;
            max-width: calc(100% - 2rem);
            border-radius: 999px;
            background: rgba(15,23,42,0.74);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 750;
            padding: 0.42rem 0.75rem;
            backdrop-filter: blur(12px);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .post-body {
            padding: 1.25rem;
        }

        .title-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: start;
            margin-bottom: 0.75rem;
        }

        .post-title {
            color: var(--ink);
            font-size: clamp(1.45rem, 2.7vw, 2.2rem);
            font-weight: 900;
            letter-spacing: -0.8px;
            line-height: 1.08;
            margin: 0;
        }

        .rating-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            border-radius: 999px;
            background: rgba(245,158,11,0.11);
            color: #b45309;
            font-weight: 850;
            padding: 0.45rem 0.72rem;
            flex: 0 0 auto;
        }

        .caption {
            color: #334155;
            font-size: 0.97rem;
            line-height: 1.75;
            margin-bottom: 1rem;
        }

        .chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
            margin-top: 1rem;
        }

        .detail-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid rgba(99,102,241,0.18);
            border-radius: 999px;
            background: rgba(99,102,241,0.07);
            color: #475569;
            font-size: 0.82rem;
            font-weight: 750;
            padding: 0.42rem 0.72rem;
        }

        .engagement-bar {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border-top: 1px solid rgba(226,232,240,0.85);
            margin-top: 1.25rem;
        }

        .engagement-item {
            padding: 1rem 0.75rem 0;
            text-align: center;
        }

        .engagement-value {
            display: block;
            color: var(--ink);
            font-size: 1.15rem;
            font-weight: 900;
        }

        .engagement-label {
            display: block;
            color: var(--muted);
            font-size: 0.76rem;
            font-weight: 700;
            margin-top: 0.12rem;
        }

        .side-stack {
            display: grid;
            gap: 1rem;
        }

        .side-panel {
            padding: 1.15rem;
        }

        .side-title {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            color: var(--ink);
            font-size: 1rem;
            font-weight: 850;
            letter-spacing: -0.2px;
            margin-bottom: 0.9rem;
        }

        .side-title i {
            color: var(--primary);
        }

        .rating-box {
            border-radius: 14px;
            background:
                linear-gradient(135deg, rgba(99,102,241,0.1), rgba(236,72,153,0.08)),
                #fff;
            padding: 1rem;
            text-align: center;
        }

        .rating-box .star-rating {
            font-size: 1.65rem;
        }

        .star-rating-clickable i {
            padding: 0 0.08rem;
        }

        .hint-alert {
            border: 1px solid rgba(34,197,94,0.24);
            border-radius: 12px;
            background: rgba(34,197,94,0.09);
            color: #166534;
            font-size: 0.86rem;
            font-weight: 650;
            padding: 0.75rem 0.85rem;
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(226,232,240,0.8);
            padding: 0.8rem 0;
        }

        .stat-row:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .stat-row span {
            color: var(--muted);
            font-size: 0.88rem;
            font-weight: 700;
        }

        .stat-row strong {
            color: var(--ink);
            font-weight: 900;
        }

        .comments-panel {
            margin-top: 1.25rem;
        }

        .comments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.15rem;
            border-bottom: 1px solid rgba(226,232,240,0.85);
        }

        .comments-header h2 {
            color: var(--ink);
            font-size: 1.08rem;
            font-weight: 850;
            margin: 0;
        }

        .comment-form {
            padding: 1.15rem;
            border-bottom: 1px solid rgba(226,232,240,0.85);
            background: rgba(248,250,252,0.7);
        }

        .comment-form .form-control {
            border: 1.5px solid var(--line);
            border-radius: 14px;
            resize: vertical;
            min-height: 100px;
            padding: 0.85rem;
        }

        .comment-form .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }

        .comment-list {
            padding: 0.25rem 1.15rem 1.15rem;
        }

        .comment-item {
            display: flex;
            gap: 0.8rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(226,232,240,0.75);
        }

        .comment-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .comment-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 900;
            flex: 0 0 auto;
        }

        .comment-content {
            min-width: 0;
            flex: 1;
        }

        .comment-top {
            display: flex;
            justify-content: space-between;
            gap: 0.8rem;
            align-items: start;
        }

        .comment-author {
            color: var(--ink);
            font-weight: 850;
            font-size: 0.92rem;
        }

        .comment-time {
            color: var(--muted);
            font-size: 0.76rem;
            font-weight: 650;
        }

        .comment-body {
            color: #334155;
            line-height: 1.6;
            margin: 0.45rem 0 0;
        }

        .empty-comments {
            padding: 2.25rem 1rem;
            text-align: center;
            color: var(--muted);
        }

        .toast {
            border: 1px solid rgba(34,197,94,0.25);
            border-radius: 14px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        @media (max-width: 575.98px) {
            .post-header,
            .title-row,
            .comments-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .owner-actions {
                width: 100%;
            }

            .owner-actions .btn,
            .owner-actions form {
                flex: 1;
            }

            .owner-actions button {
                width: 100%;
            }

            .engagement-bar {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
    @endpush

    <div class="container photo-detail-shell">
        <div class="detail-grid">
            <div>
                <article class="post-panel">
                    <header class="post-header">
                        <div class="creator-wrap">
                            <span class="avatar">{{ strtoupper(Str::substr($photo->user->name, 0, 1)) }}</span>
                            <div class="min-w-0">
                                <div class="creator-name">{{ $photo->user->name }}</div>
                                <div class="post-meta">
                                    <span class="badge badge-creator me-1">Creator</span>
                                    <i class="bi bi-clock me-1"></i>{{ $photo->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        @if(auth()->id() === $photo->user_id)
                            <div class="owner-actions">
                                <a href="{{ route('photos.edit', $photo) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <form action="{{ route('photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Delete this photo permanently?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </header>

                    <div class="photo-stage">
                        <img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->title }}">
                        @if($photo->location)
                            <span class="photo-overlay-chip"><i class="bi bi-geo-alt-fill me-1"></i>{{ $photo->location }}</span>
                        @endif
                    </div>

                    <div class="post-body">
                        <div class="title-row">
                            <h1 class="post-title">{{ $photo->title }}</h1>
                            <span class="rating-pill">
                                <i class="bi bi-star-fill"></i>{{ number_format($photo->avg_rating, 1) }}
                            </span>
                        </div>

                        @if($photo->caption)
                            <p class="caption">{{ $photo->caption }}</p>
                        @else
                            <p class="caption text-muted">No caption added for this photo yet.</p>
                        @endif

                        <div class="chip-row">
                            <span class="detail-chip"><i class="bi bi-person-circle"></i>{{ $photo->user->name }}</span>
                            @if($photo->location)
                                <span class="detail-chip"><i class="bi bi-geo-alt-fill"></i>{{ $photo->location }}</span>
                            @endif
                            @if($photo->people)
                                <span class="detail-chip"><i class="bi bi-people-fill"></i>{{ $photo->people }}</span>
                            @endif
                        </div>

                        <div class="engagement-bar">
                            <div class="engagement-item">
                                <span class="engagement-value">{{ number_format($photo->avg_rating, 1) }}</span>
                                <span class="engagement-label">Average rating</span>
                            </div>
                            <div class="engagement-item">
                                <span class="engagement-value">{{ $photo->rating_count }}</span>
                                <span class="engagement-label">{{ Str::plural('Rating', $photo->rating_count) }}</span>
                            </div>
                            <div class="engagement-item">
                                <span class="engagement-value">{{ $photo->comments->count() }}</span>
                                <span class="engagement-label">{{ Str::plural('Comment', $photo->comments->count()) }}</span>
                            </div>
                        </div>
                    </div>
                </article>

                <section class="comments-panel">
                    <div class="comments-header">
                        <h2><i class="bi bi-chat-dots-fill me-1"></i>Comments</h2>
                        <span class="detail-chip">{{ $photo->comments->count() }} total</span>
                    </div>

                    @auth
                        <form action="{{ route('comments.store', $photo) }}" method="POST" class="comment-form">
                            @csrf
                            <textarea
                                name="body"
                                class="form-control @error('body') is-invalid @enderror"
                                rows="3"
                                placeholder="Add a thoughtful comment..."
                                required
                            >{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send-fill me-1"></i>Post comment
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="comment-form">
                            <div class="alert alert-info mb-0">
                                <a href="{{ route('login') }}">Login</a> to post a comment.
                            </div>
                        </div>
                    @endauth

                    <div class="comment-list">
                        @forelse($photo->comments as $comment)
                            <div class="comment-item">
                                <span class="comment-avatar">{{ strtoupper(Str::substr($comment->user->name, 0, 1)) }}</span>
                                <div class="comment-content">
                                    <div class="comment-top">
                                        <div>
                                            <span class="comment-author">{{ $comment->user->name }}</span>
                                            <span class="badge badge-{{ $comment->user->isCreator() ? 'creator' : 'consumer' }} ms-1">
                                                {{ ucfirst($comment->user->role) }}
                                            </span>
                                            <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                                        </div>

                                        @if(auth()->id() === $comment->user_id)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Delete this comment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link text-danger p-0" aria-label="Delete comment">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <p class="comment-body">{{ $comment->body }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="empty-comments">
                                <i class="bi bi-chat-heart display-6 d-block mb-2"></i>
                                No comments yet. Be the first to start the conversation.
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <aside class="side-stack">
                @auth
                    @if(auth()->id() !== $photo->user_id)
                        <section class="side-panel">
                            <h2 class="side-title"><i class="bi bi-star-fill"></i>Rate this photo</h2>

                            @if($userRating)
                                <div class="hint-alert mb-3">
                                    <i class="bi bi-check-circle-fill me-1"></i>You rated this photo <strong>{{ $userRating->score }}/5</strong>.
                                </div>
                            @endif

                            <form action="{{ route('ratings.store', $photo) }}" method="POST">
                                @csrf
                                <div class="rating-box mb-3">
                                    <div class="star-rating star-rating-clickable" id="ratingStars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i
                                                class="bi bi-star{{ $userRating && $i <= $userRating->score ? '-fill' : '' }}"
                                                data-rating="{{ $i }}"
                                                onclick="setRating({{ $i }})"
                                            ></i>
                                        @endfor
                                    </div>
                                </div>
                                <input type="hidden" name="score" id="ratingInput" value="{{ old('score', $userRating ? $userRating->score : '') }}">
                                @error('score')
                                    <div class="text-danger small mb-2">{{ $message }}</div>
                                @enderror
                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                    id="submitRating"
                                    {{ old('score', $userRating ? $userRating->score : '') ? '' : 'disabled' }}
                                >
                                    <i class="bi bi-send-fill me-1"></i>{{ $userRating ? 'Update rating' : 'Submit rating' }}
                                </button>
                            </form>
                        </section>
                    @endif
                @endauth

                <section class="side-panel">
                    <h2 class="side-title"><i class="bi bi-bar-chart-fill"></i>Post stats</h2>
                    <div class="stat-row">
                        <span>Average rating</span>
                        <strong>{{ number_format($photo->avg_rating, 1) }}/5</strong>
                    </div>
                    <div class="stat-row">
                        <span>Comments</span>
                        <strong>{{ $photo->comments->count() }}</strong>
                    </div>
                    <div class="stat-row">
                        <span>Ratings</span>
                        <strong>{{ $photo->rating_count }}</strong>
                    </div>
                    <div class="stat-row">
                        <span>Posted</span>
                        <strong>{{ $photo->created_at->format('M d, Y') }}</strong>
                    </div>
                </section>

                <section class="side-panel">
                    <h2 class="side-title"><i class="bi bi-person-badge-fill"></i>Creator</h2>
                    <div class="creator-wrap">
                        <span class="avatar">{{ strtoupper(Str::substr($photo->user->name, 0, 1)) }}</span>
                        <div>
                            <div class="creator-name">{{ $photo->user->name }}</div>
                            <div class="post-meta">{{ ucfirst($photo->user->role) }} on PhotoShare</div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

        @if(session('success'))
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div class="toast show" role="alert">
                    <div class="toast-header bg-success text-white">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        function setRating(rating) {
            const input = document.getElementById('ratingInput');
            const submit = document.getElementById('submitRating');
            const stars = document.querySelectorAll('#ratingStars i');

            input.value = rating;
            submit.disabled = false;

            stars.forEach((star, index) => {
                star.classList.toggle('bi-star-fill', index < rating);
                star.classList.toggle('bi-star', index >= rating);
            });
        }
    </script>
    @endpush
</x-app-layout>
