<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $recommended = Destination::query()->orderByDesc('most_booked')->take(6)->get();
        
        // Hanya ambil tiket yang statusnya available DAN tanggal kunjungannya >= hari ini
        $tickets = Ticket::query()
            ->with(['destination', 'transaction'])
            ->where('user_id', $request->user()->id)
            ->where('status', 'available')
            ->whereHas('transaction', function ($q) {
                $q->whereDate('visit_date', '>=', \Carbon\Carbon::today());
            })
            ->latest()
            ->take(4)
            ->get();

        return view('buyer.dashboard', compact('recommended', 'tickets'));
    }
}
