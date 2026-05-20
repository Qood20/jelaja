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

        // Cari tiket yang sesuai dengan payload DAN pastikan itu milik destinasi operator ini
        $ticket = Ticket::query()
            ->whereHas('destination', fn ($q) => $q->where('operator_id', $request->user()->id))
            ->where('qr_code_payload', $data['qr_payload'])
            ->first();

        if (! $ticket) {
            return back()->withErrors(['qr_payload' => 'QR Code tidak ditemukan atau tiket bukan milik destinasi Anda.']);
        }

        // CEK 1: Apakah sudah pernah dipakai? (Sesuai permintaanmu: Hanya bisa 1x pakai)
        if ($ticket->status === 'used') {
            return back()->withErrors(['qr_payload' => 'GAGAL: Tiket ini sudah pernah digunakan pada ' . $ticket->used_at->format('d M Y, H:i')]);
        }

        // CEK 2: Apakah statusnya valid (bukan kedaluwarsa dll)
        if ($ticket->status !== 'available') {
            return back()->withErrors(['qr_payload' => 'Tiket tidak dapat digunakan (Status: ' . $ticket->status . ')']);
        }

        // CEK 3: Apakah tanggal kunjungannya hari ini?
        $today = now()->toDateString();
        if ($ticket->transaction->visit_date->toDateString() !== $today) {
            return back()->withErrors(['qr_payload' => 'Tiket tidak valid untuk hari ini. Tanggal kunjungan seharusnya: ' . $ticket->transaction->visit_date->format('d M Y')]);
        }

        // Jika semua lolos, tandai sebagai TERPAKAI
        $ticket->update([
            'status' => 'used',
            'used_at' => now(),
        ]);

        return back()->with('success', 'VERIFIKASI BERHASIL: Tiket valid dan sudah ditandai sebagai terpakai.');
    }
}
