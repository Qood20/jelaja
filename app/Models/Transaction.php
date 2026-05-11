<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'destination_id', 'order_id', 'gross_amount', 'status', 'midtrans_token', 'midtrans_redirect_url', 'paid_at', 'visit_date', 'quantity'])]
class Transaction extends Model
{
    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
            'visit_date' => 'date',
        ];
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }

    public function tickets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Generate tickets for this transaction if they don't exist yet.
     */
    public function generateTickets(): void
    {
        if ($this->status !== 'paid') {
            return;
        }

        \Illuminate\Support\Facades\DB::transaction(function () {
            // Lock the transaction record for update to prevent race conditions
            $transaction = Transaction::where('id', $this->id)->lockForUpdate()->first();

            if ($transaction->tickets()->exists()) {
                return;
            }

            for ($i = 1; $i <= $this->quantity; $i++) {
                Ticket::create([
                    'transaction_id' => $this->id,
                    'user_id' => $this->user_id,
                    'destination_id' => $this->destination_id,
                    'status' => 'available',
                    'qr_code_payload' => 'TKT-' . $this->order_id . '-' . $i . '-' . strtoupper(bin2hex(random_bytes(2))),
                ]);
            }
        });
    }
}
