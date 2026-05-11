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
        $destinations = Destination::query()->where('operator_id', $request->user()->id)->latest()->get();
        $usedTickets = Ticket::query()
            ->whereHas('destination', fn ($q) => $q->where('operator_id', $request->user()->id))
            ->where('status', 'used')
            ->count();

        return view('operator.dashboard', compact('destinations', 'usedTickets'));
    }
}
