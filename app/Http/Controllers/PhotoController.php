<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // Show upload form (Creator only)
    public function create()
    {
        return view('photos.create');
    }

    // Store new photo (Creator only)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'people' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        // Store image
        $imagePath = $request->file('image')->store('photos', 'public');

        // Create photo record
        Photo::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'caption' => $request->caption,
            'location' => $request->location,
            'people' => $request->people,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Photo uploaded successfully!');
    }

    // Show single photo with comments
    public function show(Photo $photo)
    {
        $photo->load(['user', 'comments.user', 'ratings']);
        
        $userRating = null;
        if (auth()->check()) {
            $userRating = $photo->getUserRating(auth()->id());
        }

        return view('photos.show', compact('photo', 'userRating'));
    }

    // Show edit form (Creator only, own photos)
    public function edit(Photo $photo)
    {
        // Check ownership
        if ($photo->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('photos.edit', compact('photo'));
    }

    // Update photo (Creator only, own photos)
    public function update(Request $request, Photo $photo)
    {
        // Check ownership
        if ($photo->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'people' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Update image if new one uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($photo->image_path);
            
            // Store new image
            $imagePath = $request->file('image')->store('photos', 'public');
            $photo->image_path = $imagePath;
        }

        // Update other fields
        $photo->update($request->only(['title', 'caption', 'location', 'people']));

        return redirect()->route('dashboard')
            ->with('success', 'Photo updated successfully!');
    }

    // Delete photo (Creator only, own photos)
    public function destroy(Photo $photo)
    {
        // Check ownership
        if ($photo->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image file
        Storage::disk('public')->delete($photo->image_path);

        // Delete photo record (comments and ratings will cascade delete)
        $photo->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Photo deleted successfully!');
    }

    // Search photos
    public function search(Request $request)
    {
        $query = Photo::with('user')->withCount('comments', 'ratings');

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('caption', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhere('people', 'like', "%{$searchTerm}%");
            });
        }

        $photos = $query->latest()->paginate(12);
        $searchQuery = $request->q;

        return view('photos.search', compact('photos', 'searchQuery'));
    }
}