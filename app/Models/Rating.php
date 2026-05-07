<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo_id',
        'score',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    // Auto-update photo's average rating after saving
    protected static function booted()
    {
        static::saved(function ($rating) {
            $rating->photo->updateAverageRating();
        });

        static::deleted(function ($rating) {
            $rating->photo->updateAverageRating();
        });
    }
}