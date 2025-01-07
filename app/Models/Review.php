<?php

namespace App\Models;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'destination_id',
        'user_id',
        'rating',
        'comment'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
