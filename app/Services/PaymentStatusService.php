<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Stocks;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

/**
 * Menerapkan status pembayaran dari Midtrans ke transaksi lokal secara
 * idempoten: stok hanya dikurangi sekali, saat transaksi pertama kali lunas.
 */
class PaymentStatusService
{
    public function apply(string $orderId, string $status, ?string $paymentType = null, ?string $fraudStatus = null): ?Transaction
    {
        // Transaksi kartu kredit yang ditandai "challenge" belum boleh dianggap lunas.
        if ($status === 'capture' && $fraudStatus === 'challenge') {
            $status = 'pending';
        }

        return DB::transaction(function () use ($orderId, $status, $paymentType) {
            $transaction = Transaction::query()->lockForUpdate()->find($orderId);

            if (! $transaction) {
                return null;
            }

            $wasPaid = $transaction->isPaid();

            // Jangan menurunkan status transaksi yang sudah lunas (mis. notifikasi
            // "pending" yang datang terlambat), kecuali refund.
            if ($wasPaid && ! in_array($status, [...Transaction::PAID_STATUSES, 'refund', 'partial_refund'], true)) {
                return $transaction;
            }

            $transaction->status = $status;
            $transaction->payment_method = $paymentType ?? $transaction->payment_method;

            if (! $wasPaid && $transaction->isPaid()) {
                $transaction->paid_at = now();
                $this->decrementStock($transaction);
            }

            $transaction->save();

            Payment::query()
                ->where('transaction_id', $transaction->transaction_id)
                ->update(['status' => $status]);

            return $transaction;
        });
    }

    private function decrementStock(Transaction $transaction): void
    {
        $payments = Payment::query()
            ->where('transaction_id', $transaction->transaction_id)
            ->whereNotNull('size')
            ->get();

        foreach ($payments as $payment) {
            $stock = Stocks::query()
                ->where('product_id', $payment->product_id)
                ->where('size', $payment->size)
                ->lockForUpdate()
                ->first();

            if ($stock) {
                $stock->total_stock = max(0, $stock->total_stock - $payment->qty);
                $stock->save();
            }
        }
    }
}
