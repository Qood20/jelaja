<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        $today = now();

        $dailyRevenue = Transaction::query()
            ->whereDate('created_at', $today)
            ->sum('gross_amount');

        $monthlyRevenue = Transaction::query()
            ->whereYear('created_at', $today->year)
            ->whereMonth('created_at', $today->month)
            ->sum('gross_amount');

        $transactions = Transaction::query()
            ->with('destination', 'buyer')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();

        return view('admin.reports.finance', compact('dailyRevenue', 'monthlyRevenue', 'transactions'));
    }
}
