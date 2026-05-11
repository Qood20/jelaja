<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        if (! Transaction::exists()) {
            $this->call(TransactionSeeder::class);
        }

        $paidTransactions = Transaction::where('status', 'paid')->get();

        foreach ($paidTransactions as $transaction) {
            Ticket::updateOrCreate(
                ['transaction_id' => $transaction->id],
                [
                    'user_id' => $transaction->user_id,
                    'destination_id' => $transaction->destination_id,
                    'status' => 'available',
                    'qr_code_payload' => Str::uuid()->toString(),
                    'used_at' => null,
                ],
            );
        }
    }
}

