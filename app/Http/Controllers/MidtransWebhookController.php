<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Supaya robot Midtrans tidak diblokir Ngrok
        header('ngrok-skip-browser-warning: true');

        $notif = $request->all();

        Log::info('Data dari Midtrans:', $notif);

        $orderId = $notif['order_id'] ?? null;
        $transactionStatus = $notif['transaction_status'] ?? null;

        if (!$orderId || !$transactionStatus) {
            Log::warning('Midtrans webhook missing order_id/transaction_status', [
                'has_order_id' => array_key_exists('order_id', $notif),
                'has_transaction_status' => array_key_exists('transaction_status', $notif),
            ]);

            return response()->json(['message' => 'Webhook Berhasil (ignored payload)'], 200);

        }

        // Cari transaksi di database
        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            $before = $transaction->status;

            $newStatus = match ($transactionStatus) {
                'settlement', 'capture' => 'paid',
                'pending' => 'pending',
                'deny', 'expire', 'cancel', 'failed', 'failure' => 'expired',
                default => null,
            };

            if ($newStatus) {
                $update = ['status' => $newStatus];

                if ($newStatus === 'paid') {
                    $update['paid_at'] = now();
                }

                $transaction->update($update);

                if ($newStatus === 'paid') {
                    $transaction->generateTickets();
                }

                Log::info('Midtrans webhook status updated', [
                    'order_id' => $orderId,
                    'transaction_status' => $transactionStatus,
                    'before_status' => $before,
                    'after_status' => $transaction->fresh()->status,
                ]);
            } else {
                Log::warning('Midtrans webhook got unhandled status', [
                    'order_id' => $orderId,
                    'transaction_status' => $transactionStatus,
                    'before_status' => $before,
                ]);
            }
        } else {
            Log::warning('Midtrans webhook transaction not found', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
            ]);
        }

        return response()->json(['message' => 'Webhook Berhasil'], 200);
    }
}

