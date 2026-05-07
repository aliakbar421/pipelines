<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isCreator()) {
            // Creator sees their uploaded photos
            $photos = Photo::where('user_id', $user->id)
                ->withCount('comments', 'ratings')
                ->latest()
                ->paginate(12);

            $creatorStats = [
                'photos' => Photo::where('user_id', $user->id)->count(),
                'comments' => Comment::whereHas('photo', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count(),
                'ratings' => Rating::whereHas('photo', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count(),
                'avg_rating' => Photo::where('user_id', $user->id)
                    ->where('rating_count', '>', 0)
                    ->avg('avg_rating') ?? 0,
            ];

            $featuredPhoto = Photo::where('user_id', $user->id)
                ->withCount('comments', 'ratings')
                ->orderByDesc('avg_rating')
                ->orderByDesc('rating_count')
                ->latest()
                ->first();
            
            return view('dashboard.creator', compact('photos', 'creatorStats', 'featuredPhoto'));
        } else {
            $photos = Photo::with('user')
                ->withCount('comments', 'ratings')
                ->latest()
                ->paginate(12);
            
            return view('dashboard.consumer', compact('photos'));
        }
    }
}
