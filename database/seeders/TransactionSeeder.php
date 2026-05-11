<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $buyer1 = User::where('email', 'buyer1@jelaja.test')->first();
        $buyer2 = User::where('email', 'buyer2@jelaja.test')->first();

        if (! $buyer1 || ! $buyer2) {
            $this->call(UserSeeder::class);
            $buyer1 = User::where('email', 'buyer1@jelaja.test')->first();
            $buyer2 = User::where('email', 'buyer2@jelaja.test')->first();
        }

        if (! Destination::exists()) {
            $this->call(DestinationSeeder::class);
        }

        $destination = Destination::first();
        if (! $destination) {
            return;
        }

        Transaction::query()->delete();

        // Transaksi paid untuk buyer1
        Transaction::create([
            'user_id' => $buyer1->id,
            'destination_id' => $destination->id,
            'order_id' => 'SEED-PAID-001',
            'gross_amount' => $destination->price,
            'status' => 'paid',
            'midtrans_token' => null,
            'midtrans_redirect_url' => null,
            'visit_date' => now()->addDay(),
            'quantity' => 1,
            'paid_at' => now()->subDay(),
        ]);

        // Transaksi pending untuk buyer2
        Transaction::create([
            'user_id' => $buyer2->id,
            'destination_id' => $destination->id,
            'order_id' => 'SEED-PENDING-001',
            'gross_amount' => $destination->price,
            'status' => 'pending',
            'midtrans_token' => 'dummy-token',
            'midtrans_redirect_url' => 'https://app.midtrans.com/dummy',
            'visit_date' => now()->addDays(2),
            'quantity' => 2,
        ]);
    }
}

