<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Stocks;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsShop;
use Tests\Fakes\FakePaymentGateway;
use Tests\TestCase;

class PaymentNotificationTest extends TestCase
{
    use BuildsShop, RefreshDatabase;

    private function pendingOrder(int $qty = 2): Transaction
    {
        $customer = $this->makeCustomer();
        $product = $this->makeProduct(['40' => 5]);

        $transaction = Transaction::create([
            'transaction_id' => 'SKO-TEST-1',
            'customer_id' => $customer->customer_id,
            'status' => 'pending',
            'total_payment' => $product->price * $qty,
        ]);

        Payment::create([
            'payment_id' => 'PY001',
            'transaction_id' => $transaction->transaction_id,
            'customer_id' => $customer->customer_id,
            'product_id' => $product->product_id,
            'size' => '40',
            'qty' => $qty,
            'total_price' => $product->price * $qty,
            'status' => 'pending',
        ]);

        return $transaction;
    }

    private function notify(array $payload, ?string $signature = null)
    {
        $payload = array_merge([
            'order_id' => 'SKO-TEST-1',
            'status_code' => '200',
            'gross_amount' => '500000.00',
            'transaction_status' => 'settlement',
            'payment_type' => 'bank_transfer',
        ], $payload);
        $payload['signature_key'] = $signature ?? FakePaymentGateway::sign($payload);

        return $this->postJson('/payment/notification', $payload);
    }

    public function test_rejects_invalid_signature(): void
    {
        $this->fakeGateway();
        $this->pendingOrder();

        $this->notify([], 'forged')->assertForbidden();
        $this->assertSame('pending', Transaction::sole()->status);
    }

    public function test_settlement_marks_paid_and_decrements_stock_once(): void
    {
        $this->fakeGateway();
        $this->pendingOrder(qty: 2);

        $this->notify([])->assertOk();
        $this->notify([])->assertOk(); // notifikasi ganda dari Midtrans

        $transaction = Transaction::sole();
        $this->assertSame('settlement', $transaction->status);
        $this->assertSame('bank_transfer', $transaction->payment_method);
        $this->assertNotNull($transaction->paid_at);
        $this->assertSame('settlement', Payment::sole()->status);
        $this->assertSame(3, Stocks::sole()->total_stock);
    }

    public function test_late_pending_notification_does_not_downgrade_paid_order(): void
    {
        $this->fakeGateway();
        $this->pendingOrder();

        $this->notify(['transaction_status' => 'settlement']);
        $this->notify(['transaction_status' => 'pending', 'status_code' => '201']);

        $this->assertSame('settlement', Transaction::sole()->status);
    }

    public function test_expire_and_fraud_challenge_are_not_paid(): void
    {
        $this->fakeGateway();
        $this->pendingOrder();

        $this->notify(['transaction_status' => 'capture', 'fraud_status' => 'challenge']);
        $this->assertSame('pending', Transaction::sole()->status);

        $this->notify(['transaction_status' => 'expire', 'status_code' => '407']);
        $this->assertSame('expire', Transaction::sole()->status);
        $this->assertSame(5, Stocks::sole()->total_stock);
    }

    public function test_unknown_order_is_acknowledged(): void
    {
        $this->fakeGateway();

        $this->notify(['order_id' => 'UNKNOWN'])->assertOk();
    }

    public function test_legacy_webhook_url_also_works(): void
    {
        $this->fakeGateway();
        $this->pendingOrder();

        $payload = ['order_id' => 'SKO-TEST-1', 'status_code' => '200', 'gross_amount' => '1.00', 'transaction_status' => 'settlement'];
        $payload['signature_key'] = FakePaymentGateway::sign($payload);

        $this->postJson('/payment/midtrans-notification', $payload)->assertOk();
        $this->assertSame('settlement', Transaction::sole()->status);
    }
}
