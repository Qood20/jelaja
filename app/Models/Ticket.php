<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['transaction_id', 'user_id', 'destination_id', 'status', 'qr_code_payload', 'used_at'])]
class Ticket extends Model
{
    protected function casts(): array
    {
        return [
            'used_at' => 'datetime',
        ];
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
