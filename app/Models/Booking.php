<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'destination_id', 'visit_date', 'quantity', 'reserved_amount', 'status', 'reserved_at', 'expires_at', 'notes'])]
class Booking extends Model
{
    protected function casts(): array
    {
        return [
            'visit_date' => 'date',
            'reserved_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
