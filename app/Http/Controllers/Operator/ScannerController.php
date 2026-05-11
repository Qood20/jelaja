<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index()
    {
        return view('operator.scanner');
    }

    public function verify(Request $request)
    {
        $data = $request->validate([
            'qr_payload' => ['required', 'string'],
        ]);

        $ticket = Ticket::query()->where('qr_code_payload', $data['qr_payload'])->first();

        if (! $ticket) {
            return back()->withErrors(['qr_payload' => 'QR Code tidak ditemukan.']);
        }

        if ($ticket->status !== 'available') {
            return back()->withErrors(['qr_payload' => 'Tiket sudah digunakan sebelumnya.']);
        }

        $today = now()->toDateString();
        if ($ticket->transaction->visit_date->toDateString() !== $today) {
            return back()->withErrors(['qr_payload' => 'Tiket tidak valid untuk hari ini. Tanggal kunjungan: ' . $ticket->transaction->visit_date->format('d M Y')]);
        }

        $ticket->update([
            'status' => 'used',
            'used_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Tiket valid dan berhasil digunakan.');
    }
}
