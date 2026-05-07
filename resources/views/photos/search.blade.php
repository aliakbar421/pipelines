<x-app-layout>
    <div class="container">
        <!-- Search Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-3">
                    <i class="bi bi-search"></i> Search Photos
                </h2>
            </div>
        </div>

        <!-- Search Form -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <form action="{{ route('photos.search') }}" method="GET">
                    <div class="input-group input-group-lg">
                        <input type="text" name="q" class="form-control" 
                               placeholder="Search by title, caption, location, or people..." 
                               value="{{ $searchQuery ?? '' }}" autofocus>
                        <button class="btn btn-primary px-4" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results -->
        @if(isset($searchQuery) && $searchQuery)
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill"></i> 
                    Found <strong>{{ $photos->total() }}</strong> result(s) for "<strong>{{ $searchQuery }}</strong>"
                </div>
            </div>
        </div>
        @endif

        <!-- Photos Grid -->
        @if($photos->count() > 0)
        <div class="row g-4">
            @foreach($photos as $photo)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100">
                    <img src="{{ Storage::url($photo->image_path) }}" class="photo-card-img" alt="{{ $photo->title }}">
                    <div class="card-body">
                        <h6 class="card-title fw-bold mb-2">{{ $photo->title }}</h6>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-person-circle"></i> {{ $photo->user->name }}
                        </p>
                        
                        @if($photo->location)
                        <p class="text-muted small mb-2">
                            <i class="bi bi-geo-alt-fill text-danger"></i> {{ $photo->location }}
                        </p>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="star-rating small">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= round($photo->avg_rating) ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <span class="text-muted small">
                                <i class="bi bi-chat-fill"></i> {{ $photo->comments_count }}
                            </span>
                        </div>

                        <a href="{{ route('photos.show', $photo) }}" class="btn btn-sm btn-primary w-100">
                            <i class="bi bi-eye"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $photos->appends(['q' => $searchQuery])->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted"></i>
            <h3 class="mt-3">No results found</h3>
            @if(isset($searchQuery) && $searchQuery)
            <p class="text-muted">Try different keywords or browse all photos</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                <i class="bi bi-house-fill"></i> Back to Home
            </a>
            @else
            <p class="text-muted">Enter a search term to find photos</p>
            @endif
        </div>
        @endif
    </div>
</x-app-layout>