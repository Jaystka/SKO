<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function dashboardView()
    {
        $paid = Transaction::query()->whereIn('status', Transaction::PAID_STATUSES);
        $monthStart = now()->startOfMonth();

        $stats = [
            'income_month' => (int) (clone $paid)->where('paid_at', '>=', $monthStart)->sum('total_payment'),
            'income_total' => (int) (clone $paid)->sum('total_payment'),
            'orders_paid' => (clone $paid)->count(),
            'orders_pending' => Transaction::query()->where('status', 'pending')->count(),
            'customers' => Customer::query()->count(),
            'products' => Product::query()->count(),
        ];

        // Pendapatan 6 bulan terakhir (dihitung di PHP agar portabel MySQL/SQLite).
        $from = now()->subMonths(5)->startOfMonth();
        $byMonth = Transaction::query()
            ->whereIn('status', Transaction::PAID_STATUSES)
            ->where('paid_at', '>=', $from)
            ->get(['paid_at', 'total_payment'])
            ->groupBy(fn (Transaction $t) => $t->paid_at->format('Y-m'))
            ->map(fn ($group) => (int) $group->sum('total_payment'));

        $monthly = collect(range(0, 5))->map(function (int $i) use ($from, $byMonth) {
            $month = $from->copy()->addMonths($i);

            return [
                'label' => $month->translatedFormat('M Y'),
                'total' => $byMonth->get($month->format('Y-m'), 0),
            ];
        });

        $recentOrders = Payment::query()
            ->with(['product.brand', 'transaction'])
            ->latest()
            ->limit(6)
            ->get();

        return view('admin/dashboard/home', compact('stats', 'recentOrders', 'monthly'));
    }
}
