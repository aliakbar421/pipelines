<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold mb-4">
                            <i class="bi bi-upload"></i> Upload New Photo
                        </h3>

                        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf

                            <!-- Image Upload with Preview -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="preview" src="" class="img-fluid rounded" style="max-height: 300px;">
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title') }}" required 
                                       placeholder="Give your photo a catchy title">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Caption -->
                            <div class="mb-3">
                                <label for="caption" class="form-label fw-semibold">Caption</label>
                                <textarea class="form-control @error('caption') is-invalid @enderror" 
                                          id="caption" name="caption" rows="3" 
                                          placeholder="Tell us about this photo...">{{ old('caption') }}</textarea>
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
                                       id="location" name="location" value="{{ old('location') }}" 
                                       placeholder="Where was this taken?">
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
                                       id="people" name="people" value="{{ old('people') }}" 
                                       placeholder="Tag people in this photo (comma separated)">
                                @error('people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-upload"></i> Upload Photo
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
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    @endpush
</x-app-layout>