<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionAdminController extends Controller
{
    public function transactionsadminView()
    {
        $transactions = DB::table('transactions')
            ->join('customers', 'transactions.customer_id', '=', 'customers.customer_id')
            ->select('transactions.*', 'customers.name as customer_name')
            ->get();

        return view('admin/sells', compact('transactions'));
    }
}
