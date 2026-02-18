<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'additional_guests',
        'allergies',
        'guests_details',
    ];

    protected $casts = [
    'guests_details' => 'array',
];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
