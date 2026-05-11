<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class OperatorApprovalController extends Controller
{
    public function index()
    {
        $operators = User::query()
            ->where('role', 'operator')
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('admin.operator-approvals.index', compact('operators'));
    }

    public function approve(User $operator)
    {
        if ($operator->role !== 'operator') {
            abort(404);
        }

        $operator->update(['status' => 'approved']);

        return back()->with('success', 'Operator berhasil disetujui.');
    }

    public function reject(User $operator)
    {
        if ($operator->role !== 'operator') {
            abort(404);
        }

        $operator->update(['status' => 'rejected']);

        return back()->with('success', 'Operator ditolak.');
    }
}
