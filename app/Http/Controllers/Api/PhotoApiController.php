<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoApiController extends Controller
{
    /**
     * Get all photos with pagination
     * GET /api/photos
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        
        $photos = Photo::with(['user:id,name,email,role', 'comments', 'ratings'])
            ->withCount('comments', 'ratings')
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $photos,
            'message' => 'Photos retrieved successfully'
        ]);
    }

    /**
     * Get single photo by ID
     * GET /api/photos/{id}
     */
    public function show($id)
    {
        $photo = Photo::with(['user:id,name,email,role', 'comments.user', 'ratings'])
            ->withCount('comments', 'ratings')
            ->find($id);

        if (!$photo) {
            return response()->json([
                'success' => false,
                'message' => 'Photo not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $photo,
            'message' => 'Photo retrieved successfully'
        ]);
    }

    /**
     * Create new photo (Creator only)
     * POST /api/photos
     */
    public function store(Request $request)
    {
        // Check if user is creator
        if ($request->user()->role !== 'creator') {
            return response()->json([
                'success' => false,
                'message' => 'Only creators can upload photos'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'people' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Store image
        $imagePath = $request->file('image')->store('photos', 'public');

        // Create photo
        $photo = Photo::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'caption' => $request->caption,
            'location' => $request->location,
            'people' => $request->people,
            'image_path' => $imagePath,
        ]);

        $photo->load('user:id,name,email,role');

        return response()->json([
            'success' => true,
            'data' => $photo,
            'message' => 'Photo uploaded successfully'
        ], 201);
    }

    /**
     * Update photo (Creator only, own photos)
     * PUT/PATCH /api/photos/{id}
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json([
                'success' => false,
                'message' => 'Photo not found'
            ], 404);
        }

        // Check ownership
        if ($photo->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'caption' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'people' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update image if provided
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($photo->image_path);
            $imagePath = $request->file('image')->store('photos', 'public');
            $photo->image_path = $imagePath;
        }

        // Update other fields
        $photo->fill($request->only(['title', 'caption', 'location', 'people']));
        $photo->save();

        $photo->load('user:id,name,email,role');

        return response()->json([
            'success' => true,
            'data' => $photo,
            'message' => 'Photo updated successfully'
        ]);
    }

    /**
     * Delete photo (Creator only, own photos)
     * DELETE /api/photos/{id}
     */
    public function destroy(Request $request, $id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json([
                'success' => false,
                'message' => 'Photo not found'
            ], 404);
        }

        // Check ownership
        if ($photo->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action'
            ], 403);
        }

        // Delete image file
        Storage::disk('public')->delete($photo->image_path);

        // Delete photo
        $photo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Photo deleted successfully'
        ]);
    }

    /**
     * Add comment to photo
     * POST /api/photos/{id}/comments
     */
    public function addComment(Request $request, $id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json([
                'success' => false,
                'message' => 'Photo not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'body' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = Comment::create([
            'user_id' => $request->user()->id,
            'photo_id' => $photo->id,
            'body' => $request->body,
        ]);

        $comment->load('user:id,name,email,role');

        return response()->json([
            'success' => true,
            'data' => $comment,
            'message' => 'Comment added successfully'
        ], 201);
    }

    /**
     * Rate photo
     * POST /api/photos/{id}/rate
     */
    public function ratePhoto(Request $request, $id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json([
                'success' => false,
                'message' => 'Photo not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'score' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $rating = Rating::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'photo_id' => $photo->id,
            ],
            [
                'score' => $request->score,
            ]
        );

        // Reload photo to get updated average
        $photo->refresh();

        return response()->json([
            'success' => true,
            'data' => [
                'rating' => $rating,
                'photo_avg_rating' => $photo->avg_rating,
                'photo_rating_count' => $photo->rating_count,
            ],
            'message' => 'Rating submitted successfully'
        ]);
    }

    /**
     * Search photos
     * GET /api/photos/search?q=keyword
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('q', '');
        $perPage = $request->get('per_page', 15);

        $query = Photo::with(['user:id,name,email,role'])
            ->withCount('comments', 'ratings');

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('caption', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhere('people', 'like', "%{$searchTerm}%");
            });
        }

        $photos = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $photos,
            'search_term' => $searchTerm,
            'message' => 'Search completed successfully'
        ]);
    }
}