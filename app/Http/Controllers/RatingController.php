<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    // Store or update rating
    public function store(Request $request, Photo $photo)
    {
        $request->validate([
            'score' => 'required|integer|min:1|max:5',
        ]);

        // Update or create rating
        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'photo_id' => $photo->id,
            ],
            [
                'score' => $request->score,
            ]
        );

        return redirect()->back()->with('success', 'Rating submitted!');
    }
}