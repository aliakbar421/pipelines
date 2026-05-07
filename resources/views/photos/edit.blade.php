<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold mb-4">
                            <i class="bi bi-pencil-square"></i> Edit Photo
                        </h3>

                        <form action="{{ route('photos.update', $photo) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Current Image -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Current Photo</label>
                                <div>
                                    <img src="{{ Storage::url($photo->image_path) }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 300px;" 
                                         id="currentImage">
                                </div>
                            </div>

                            <!-- New Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Replace Photo (optional)</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*" onchange="previewImage(event)">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Leave empty to keep current photo</small>
                            </div>

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $photo->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Caption -->
                            <div class="mb-3">
                                <label for="caption" class="form-label fw-semibold">Caption</label>
                                <textarea class="form-control @error('caption') is-invalid @enderror" 
                                          id="caption" name="caption" rows="3">{{ old('caption', $photo->caption) }}</textarea>
                                @error('caption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div class="mb-3">
                                <label for="location" class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt-fill"></i> Location
                                </label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location', $photo->location) }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- People -->
                            <div class="mb-4">
                                <label for="people" class="form-label fw-semibold">
                                    <i class="bi bi-people-fill"></i> People Present
                                </label>
                                <input type="text" class="form-control @error('people') is-invalid @enderror" 
                                       id="people" name="people" value="{{ old('people', $photo->people) }}">
                                @error('people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Photo
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const currentImage = document.getElementById('currentImage');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    @endpush
</x-app-layout>