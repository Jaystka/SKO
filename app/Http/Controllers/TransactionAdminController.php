<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionAdminController extends Controller
{
    public function transactionsadminView(Request $request)
    {
        $status = $request->query('status');

        $transactions = Transaction::query()
            ->with('customer')
            ->when($status, fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('admin/sells', compact('transactions', 'status'));
    }
}
