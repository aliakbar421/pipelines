<x-app-layout>
    @push('styles')
    <style>
        .profile-shell {
            max-width: 1180px;
        }

        .profile-hero {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            background:
                linear-gradient(135deg, rgba(11,11,24,0.95), rgba(49,46,129,0.9)),
                var(--dark);
            color: #fff;
            padding: clamp(1.5rem, 3vw, 2.35rem);
            box-shadow: var(--shadow-md);
            margin-bottom: 1rem;
        }

        .profile-hero::before,
        .profile-hero::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
        }

        .profile-hero::before {
            width: 440px;
            height: 440px;
            top: -230px;
            right: -130px;
            background: radial-gradient(circle, rgba(236,72,153,0.34), transparent 68%);
        }

        .profile-hero::after {
            width: 360px;
            height: 360px;
            left: -140px;
            bottom: -190px;
            background: radial-gradient(circle, rgba(99,102,241,0.36), transparent 68%);
        }

        .profile-hero-content {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 1.25rem;
            align-items: end;
        }

        @media (min-width: 768px) {
            .profile-hero-content {
                grid-template-columns: auto minmax(0, 1fr) auto;
            }
        }

        .profile-avatar {
            width: 88px;
            height: 88px;
            border-radius: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient);
            color: #fff;
            font-size: 2rem;
            font-weight: 900;
            box-shadow: 0 20px 42px rgba(99,102,241,0.34);
        }

        .profile-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 999px;
            background: rgba(255,255,255,0.09);
            color: #c4b5fd;
            font-size: 0.76rem;
            font-weight: 800;
            padding: 0.35rem 0.7rem;
            margin-bottom: 0.75rem;
        }

        .profile-hero h1 {
            font-size: clamp(2rem, 4vw, 3.1rem);
            font-weight: 900;
            letter-spacing: -1.2px;
            line-height: 1.05;
            margin: 0;
        }

        .profile-hero p {
            color: #cbd5e1;
            margin: 0.65rem 0 0;
            max-width: 640px;
            line-height: 1.65;
        }

        .profile-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            color: #fff;
            font-size: 0.82rem;
            font-weight: 800;
            padding: 0.5rem 0.8rem;
            white-space: nowrap;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .stat-card,
        .settings-card,
        .danger-card {
            border: 1px solid rgba(226,232,240,0.9);
            border-radius: 18px;
            background: rgba(255,255,255,0.92);
            box-shadow: var(--shadow-sm);
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(99,102,241,0.1);
            color: var(--primary);
            font-size: 1.15rem;
            margin-bottom: 0.85rem;
        }

        .stat-value {
            display: block;
            color: var(--ink);
            font-size: 1.55rem;
            font-weight: 900;
            line-height: 1;
        }

        .stat-label {
            color: var(--muted);
            font-size: 0.82rem;
            font-weight: 700;
            margin-top: 0.28rem;
        }

        .profile-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 1rem;
            align-items: start;
        }

        @media (min-width: 992px) {
            .profile-layout {
                grid-template-columns: minmax(0, 1fr) 340px;
            }
        }

        .settings-stack {
            display: grid;
            gap: 1rem;
        }

        .settings-card,
        .danger-card {
            overflow: hidden;
        }

        .card-heading {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 1rem;
            padding: 1.15rem 1.25rem;
            border-bottom: 1px solid rgba(226,232,240,0.85);
            background: rgba(248,250,252,0.72);
        }

        .card-heading h2 {
            color: var(--ink);
            font-size: 1.08rem;
            font-weight: 900;
            letter-spacing: -0.25px;
            margin: 0;
        }

        .card-heading p {
            color: var(--muted);
            font-size: 0.84rem;
            line-height: 1.55;
            margin: 0.35rem 0 0;
        }

        .heading-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(99,102,241,0.1);
            color: var(--primary);
            flex: 0 0 auto;
        }

        .settings-body {
            padding: 1.25rem;
        }

        .form-label {
            color: #374151;
            font-size: 0.84rem;
            font-weight: 750;
            margin-bottom: 0.42rem;
        }

        .form-control {
            border: 1.5px solid var(--line);
            border-radius: 12px;
            color: var(--ink);
            font-size: 0.93rem;
            padding: 0.72rem 0.9rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }

        .field-error {
            color: #ef4444;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.35rem;
        }

        .save-note {
            color: #15803d;
            font-size: 0.85rem;
            font-weight: 750;
        }

        .verify-box {
            border: 1px solid rgba(245,158,11,0.25);
            border-radius: 12px;
            background: rgba(245,158,11,0.08);
            color: #92400e;
            font-size: 0.86rem;
            font-weight: 650;
            padding: 0.8rem;
            margin-top: 0.8rem;
        }

        .verify-box button {
            border: 0;
            background: none;
            color: #7c3aed;
            font-weight: 850;
            padding: 0;
        }

        .account-card {
            position: sticky;
            top: 92px;
        }

        .profile-preview {
            padding: 1.25rem;
            text-align: center;
        }

        .preview-avatar {
            width: 74px;
            height: 74px;
            border-radius: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient);
            color: #fff;
            font-size: 1.7rem;
            font-weight: 900;
            box-shadow: 0 14px 28px rgba(99,102,241,0.28);
            margin-bottom: 0.8rem;
        }

        .preview-name {
            color: var(--ink);
            font-size: 1.08rem;
            font-weight: 900;
            margin-bottom: 0.15rem;
        }

        .preview-email {
            color: var(--muted);
            font-size: 0.84rem;
            font-weight: 650;
            word-break: break-word;
        }

        .status-list {
            padding: 0 1.25rem 1.25rem;
        }

        .status-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            border-top: 1px solid rgba(226,232,240,0.85);
            padding: 0.85rem 0;
            color: var(--muted);
            font-size: 0.86rem;
            font-weight: 750;
        }

        .status-row strong {
            color: var(--ink);
            text-align: right;
        }

        .danger-card {
            border-color: rgba(239,68,68,0.18);
        }

        .danger-card .heading-icon {
            background: rgba(239,68,68,0.1);
            color: #ef4444;
        }

        .btn-danger {
            border: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, #ef4444, #f97316);
            font-weight: 750;
            box-shadow: 0 8px 22px rgba(239,68,68,0.24);
        }

        .modal-content {
            border: 0;
            border-radius: 18px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .modal-header {
            border-bottom: 1px solid rgba(226,232,240,0.85);
        }

        @media (max-width: 575.98px) {
            .card-heading {
                flex-direction: column-reverse;
            }

            .account-card {
                position: static;
            }
        }
    </style>
    @endpush

    @php
        $photoCount = $user->isCreator() ? $user->photos()->count() : 0;
        $commentCount = $user->comments()->count();
        $ratingCount = $user->ratings()->count();
    @endphp

    <div class="container profile-shell">
        <section class="profile-hero">
            <div class="profile-hero-content">
                <span class="profile-avatar">{{ strtoupper(Str::substr($user->name, 0, 1)) }}</span>
                <div>
                    <span class="profile-kicker"><i class="bi bi-person-gear"></i> Account settings</span>
                    <h1>{{ $user->name }}</h1>
                    <p>Manage your PhotoShare identity, login security, and account status from one professional profile workspace.</p>
                </div>
                <span class="profile-badge">
                    <i class="bi bi-patch-check-fill"></i>{{ ucfirst($user->role) }}
                </span>
            </div>
        </section>

        <section class="stats-grid" aria-label="Profile activity">
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-images"></i></span>
                <span class="stat-value">{{ $photoCount }}</span>
                <div class="stat-label">Uploaded photos</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-chat-heart"></i></span>
                <span class="stat-value">{{ $commentCount }}</span>
                <div class="stat-label">Comments posted</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-star-fill"></i></span>
                <span class="stat-value">{{ $ratingCount }}</span>
                <div class="stat-label">Ratings given</div>
            </div>
        </section>

        <div class="profile-layout">
            <div class="settings-stack">
                <section class="settings-card">
                    <div class="card-heading">
                        <div>
                            <h2>Profile information</h2>
                            <p>Update the name and email shown across your PhotoShare account.</p>
                        </div>
                        <span class="heading-icon"><i class="bi bi-person-lines-fill"></i></span>
                    </div>

                    <div class="settings-body">
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}"
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
                                    name="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}"
                                    required
                                    autocomplete="username"
                                >
                                @error('email')
                                    <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="verify-box">
                                        <i class="bi bi-envelope-exclamation me-1"></i>Your email address is unverified.
                                        <button form="send-verification">Resend verification email</button>

                                        @if (session('status') === 'verification-link-sent')
                                            <div class="mt-2 text-success fw-bold">
                                                A new verification link has been sent to your email address.
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check2-circle me-1"></i>Save profile
                                </button>

                                @if (session('status') === 'profile-updated')
                                    <span class="save-note"><i class="bi bi-check-circle-fill me-1"></i>Saved.</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </section>

                <section class="settings-card">
                    <div class="card-heading">
                        <div>
                            <h2>Password security</h2>
                            <p>Keep your account protected with a strong, private password.</p>
                        </div>
                        <span class="heading-icon"><i class="bi bi-shield-lock-fill"></i></span>
                    </div>

                    <div class="settings-body">
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="update_password_current_password" class="form-label">Current password</label>
                                <input
                                    id="update_password_current_password"
                                    name="current_password"
                                    type="password"
                                    class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif"
                                    autocomplete="current-password"
                                >
                                @if($errors->updatePassword->has('current_password'))
                                    <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $errors->updatePassword->first('current_password') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="update_password_password" class="form-label">New password</label>
                                <input
                                    id="update_password_password"
                                    name="password"
                                    type="password"
                                    class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif"
                                    autocomplete="new-password"
                                >
                                @if($errors->updatePassword->has('password'))
                                    <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $errors->updatePassword->first('password') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="update_password_password_confirmation" class="form-label">Confirm password</label>
                                <input
                                    id="update_password_password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif"
                                    autocomplete="new-password"
                                >
                                @if($errors->updatePassword->has('password_confirmation'))
                                    <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $errors->updatePassword->first('password_confirmation') }}</div>
                                @endif
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-shield-check me-1"></i>Update password
                                </button>

                                @if (session('status') === 'password-updated')
                                    <span class="save-note"><i class="bi bi-check-circle-fill me-1"></i>Saved.</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </section>

                <section class="danger-card">
                    <div class="card-heading">
                        <div>
                            <h2>Delete account</h2>
                            <p>Permanently remove your account and all related PhotoShare data.</p>
                        </div>
                        <span class="heading-icon"><i class="bi bi-exclamation-triangle-fill"></i></span>
                    </div>

                    <div class="settings-body">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="bi bi-trash3-fill me-1"></i>Delete account
                        </button>
                    </div>
                </section>
            </div>

            <aside class="settings-card account-card">
                <div class="profile-preview">
                    <span class="preview-avatar">{{ strtoupper(Str::substr($user->name, 0, 1)) }}</span>
                    <div class="preview-name">{{ $user->name }}</div>
                    <div class="preview-email">{{ $user->email }}</div>
                </div>
                <div class="status-list">
                    <div class="status-row">
                        <span>Account type</span>
                        <strong>{{ ucfirst($user->role) }}</strong>
                    </div>
                    <div class="status-row">
                        <span>Email status</span>
                        <strong>{{ $user->email_verified_at ? 'Verified' : 'Pending' }}</strong>
                    </div>
                    <div class="status-row">
                        <span>Member since</span>
                        <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h2 class="modal-title fs-5 fw-bold" id="deleteAccountModalLabel">Delete account?</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">This permanently deletes your account and related data. Enter your password to confirm.</p>

                        <label for="delete_password" class="form-label">Password</label>
                        <input
                            id="delete_password"
                            name="password"
                            type="password"
                            class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif"
                            placeholder="Enter your password"
                        >
                        @if($errors->userDeletion->has('password'))
                            <div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $errors->userDeletion->first('password') }}</div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash3-fill me-1"></i>Delete account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($errors->userDeletion->isNotEmpty())
        @push('scripts')
        <script>
            const deleteAccountModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
            deleteAccountModal.show();
        </script>
        @endpush
    @endif
</x-app-layout>
