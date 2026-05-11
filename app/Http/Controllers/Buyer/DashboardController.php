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
        $tickets = Ticket::query()
            ->with('destination', 'transaction')
            ->where('user_id', $request->user()->id)
            ->where('status', 'available')
            ->latest()
            ->take(5)
            ->get();

        return view('buyer.dashboard', compact('recommended', 'tickets'));
    }
}
