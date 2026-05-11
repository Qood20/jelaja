<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'operators' => User::query()->where('role', 'operator')->count(),
            'buyers' => User::query()->where('role', 'buyer')->count(),
            'paid_transactions' => Transaction::query()->where('status', 'paid')->count(),
        ];

        $transactions = Transaction::query()->with(['buyer', 'destination'])->latest()->take(20)->get();

        return view('admin.dashboard', compact('stats', 'transactions'));
    }
}
