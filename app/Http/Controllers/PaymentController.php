<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function confirm(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'visit_date' => ['required', 'date', 'after:today'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $total = $destination->price * $data['quantity'];

        return view('buyer.checkout.confirm', compact('destination', 'total') + $data);
    }

    public function checkout(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'visit_date' => ['required', 'date', 'after:today'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        // Check quota
        $existingBookings = \App\Models\Transaction::query()
            ->where('destination_id', $destination->id)
            ->where('visit_date', $data['visit_date'])
            ->where('status', '!=', 'expired')
            ->sum('quantity');

        if ($existingBookings + $data['quantity'] > $destination->daily_quota) {
            return back()->withErrors(['quantity' => 'Kuota harian untuk tanggal tersebut sudah penuh.']);
        }

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'JELAJA-'.now()->timestamp.'-'.uniqid();
        $grossAmount = $destination->price * $data['quantity'];

        $transaction = Transaction::create([
            'user_id' => $request->user()->id,
            'destination_id' => $destination->id,
            'order_id' => $orderId,
            'gross_amount' => $grossAmount,
            'status' => 'pending',
            'visit_date' => $data['visit_date'],
            'quantity' => $data['quantity'],
        ]);


        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $request->user()->name,
                'email' => $request->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $destination->id,
                    'price' => (int) $destination->price,
                    'quantity' => (int) $data['quantity'],
                    'name' => $destination->name,
                ]
            ],
            // callback agar user langsung kembali ke website jelaja
            'callbacks' => [
                'finish' => route('payments.midtrans.finish'),
                'unfinish' => route('payments.midtrans.unfinish'),
                'error' => route('payments.midtrans.unfinish'),
            ],
            'notify_url' => route('payments.webhook'),
            // ini penting agar redirect success/fail mengarah ke website, bukan halaman midtrans
            'enabled_payments' => ['gopay','qris','bank_transfer','ewallet','credit_card'],
        ];

        $snap = Snap::createTransaction($params);
        $transaction->update([
            'midtrans_token' => $snap->token ?? null,
            'midtrans_redirect_url' => $snap->redirect_url ?? null,
        ]);

        return redirect($transaction->midtrans_redirect_url ?? route('buyer.transactions.index'));
    }

    public function simulateSuccess(string $order_id)
    {
        abort_unless(app()->isLocal(), 404);

        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();
        abort_if($transaction->user_id !== auth()->id(), 403);

        $transaction->update(['status' => 'paid', 'paid_at' => now()]);
        $transaction->generateTickets();

        return redirect()->route('buyer.tickets.index')->with('success', 'Transaksi telah disimulasikan sukses. Tiket telah dibuat.');
    }
}
