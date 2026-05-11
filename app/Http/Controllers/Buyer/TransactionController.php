<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::query()
            ->with('destination')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('buyer.transactions.index', compact('transactions'));
    }
}
