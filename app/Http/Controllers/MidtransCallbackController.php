<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Transaction as MidtransTransaction;

class MidtransCallbackController extends Controller
{
    public function finish(Request $request)
    {
        $data = $request->all();
        Log::info('Midtrans finish callback payload', $data);

        $orderId = $data['order_id'] ?? null;
        $transactionStatus = $data['transaction_status'] ?? null;

        if (!$transactionStatus && $orderId) {
            $transactionStatus = $this->getMidtransStatus($orderId);
        }

        $transaction = null;
        if ($orderId) {
            $transaction = Transaction::where('order_id', $orderId)->first();

            // fallback update (webhook lebih authoritative, tapi ini supaya user langsung lihat hasil)
            if ($transaction) {
                $status = $this->mapStatus($transactionStatus);
                if ($status) {
                    $transaction->update(['status' => $status] + ($status === 'paid' ? ['paid_at' => now()] : []));

                    if ($status === 'paid') {
                        $transaction->generateTickets();
                    }
                }
            }
        }

        if ($transaction && $transaction->status === 'paid') {
            return redirect()->route('buyer.tickets.index')->with('success', 'Pembayaran berhasil. Tiket Anda sudah siap!');
        }

        return redirect()->route('buyer.transactions.index')->with('error', 'Pembayaran gagal / belum berhasil diproses.');
    }

    public function unfinish(Request $request)
    {
        $data = $request->all();
        Log::info('Midtrans unfinish callback payload', $data);

        $orderId = $data['order_id'] ?? null;
        $transactionStatus = $data['transaction_status'] ?? null;

        if (!$transactionStatus && $orderId) {
            $transactionStatus = $this->getMidtransStatus($orderId);
        }

        $transaction = null;
        if ($orderId) {
            $transaction = Transaction::where('order_id', $orderId)->first();
            if ($transaction) {
                $status = $this->mapStatus($transactionStatus) ?? 'expired';
                $transaction->update(['status' => $status] + ($status === 'paid' ? ['paid_at' => now()] : []));
            }
        }

        return redirect()->route('buyer.transactions.index')->with('error', 'Pembayaran dibatalkan / tidak berhasil.');
    }

    private function getMidtransStatus(string $orderId): ?string
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');

        $status = MidtransTransaction::status($orderId);

        return $status['transaction_status'] ?? null;
    }

    private function mapStatus(?string $transactionStatus): ?string
    {
        if (!$transactionStatus) {
            return null;
        }

        return match ($transactionStatus) {
            'settlement', 'capture' => 'paid',
            'pending' => 'pending',
            'deny', 'expire', 'cancel', 'failed' => 'expired',
            default => null,
        };
    }
}

