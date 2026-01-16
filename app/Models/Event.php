<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'date-start',
        'date-end',
        'location',
        'cover_image',
        'max_participants',
        'max_participants_per_user',
        'is_public',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
