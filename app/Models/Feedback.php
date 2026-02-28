<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model

{
    protected $table = 'feedbacks';
    protected $fillable = [
        'event_id',
        'registration_id',
        'rating',
        'comment'
    ];

    /**
     * L'événement concerné.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Le participant ayant donné son avis.
     */
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
