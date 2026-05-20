<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $operatorId = $request->user()->id;
        $destinations = Destination::query()->where('operator_id', $operatorId)->latest()->get();
        
        // Menghitung tiket yang SUDAH di-scan petugas
        $usedTickets = Ticket::query()
            ->whereHas('destination', fn ($q) => $q->where('operator_id', $operatorId))
            ->where('status', 'used')
            ->count();

        // Menghitung SEMUA tiket yang sudah dibayar (terjual)
        $soldTickets = Ticket::query()
            ->whereHas('destination', fn ($q) => $q->where('operator_id', $operatorId))
            ->whereHas('transaction', fn ($q) => $q->where('status', 'paid'))
            ->count();

        // Menghitung total uang/pendapatan yang sudah masuk
        $totalRevenue = \App\Models\Transaction::query()
            ->whereHas('destination', fn ($q) => $q->where('operator_id', $operatorId))
            ->where('status', 'paid')
            ->sum('gross_amount');

        // Breakdown pendapatan per destinasi
        $revenueShare = Destination::query()
            ->where('operator_id', $operatorId)
            ->withCount(['tickets as tickets_sold' => function ($query) {
                $query->whereHas('transaction', fn ($q) => $q->where('status', 'paid'));
            }])
            ->get()
            ->map(function ($dest) {
                $dest->revenue = \App\Models\Transaction::query()
                    ->where('destination_id', $dest->id)
                    ->where('status', 'paid')
                    ->sum('gross_amount');
                return $dest;
            });

        // Daftar 5 transaksi sukses terbaru
        $recentTransactions = \App\Models\Transaction::query()
            ->with(['destination', 'buyer'])
            ->whereHas('destination', fn ($q) => $q->where('operator_id', $operatorId))
            ->where('status', 'paid')
            ->latest('paid_at')
            ->take(5)
            ->get();

        // Daftar pengunjung harian (tiket yang di-scan hari ini)
        $todayVisitors = Ticket::query()
            ->with(['buyer', 'destination'])
            ->whereHas('destination', fn ($q) => $q->where('operator_id', $operatorId))
            ->where('status', 'used')
            ->whereDate('used_at', \Carbon\Carbon::today())
            ->latest('used_at')
            ->get();

        return view('operator.dashboard', compact('destinations', 'usedTickets', 'soldTickets', 'totalRevenue', 'todayVisitors', 'revenueShare', 'recentTransactions'));
    }
}
