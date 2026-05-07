<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'caption',
        'location',
        'people',
        'image_path',
        'avg_rating',
        'rating_count',
    ];

    protected $casts = [
        'avg_rating' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Helper to check if user has rated this photo
    public function hasRatedBy($userId)
    {
        return $this->ratings()->where('user_id', $userId)->exists();
    }

    // Get user's rating for this photo
    public function getUserRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }

    // Update average rating
    public function updateAverageRating()
    {
        $this->avg_rating = $this->ratings()->avg('score');
        $this->rating_count = $this->ratings()->count();
        $this->save();
    }
}