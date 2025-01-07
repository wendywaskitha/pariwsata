<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'latitude',
        'longitude',
        'address',
        'contact_info',
        'image'
    ];

    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Accessor untuk rating
    public function getRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    // Accessor untuk jumlah reviews
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

}
