<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $transactions = \App\Models\Transaction::query()
            ->with(['destination', 'tickets'])
            ->where('user_id', $request->user()->id)
            ->where('status', 'paid')
            ->latest('paid_at')
            ->paginate(10);

        return view('buyer.tickets.index', compact('transactions'));
    }

    public function show(Request $request, Ticket $ticket)
    {
        abort_if($ticket->user_id !== $request->user()->id, 403);

        $transaction = $ticket->transaction()->with(['destination', 'tickets'])->firstOrFail();

        return view('buyer.tickets.show', compact('transaction'));
    }

    public function download(Request $request, Ticket $ticket)
    {
        abort_if($ticket->user_id !== $request->user()->id, 403);

        $ticket->load(['destination', 'transaction']);

        $pdf = Pdf::loadView('buyer.tickets.pdf', compact('ticket'));

        return $pdf->download('tiket-jelaja-'.$ticket->id.'.pdf');
    }
}
