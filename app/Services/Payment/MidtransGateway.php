<?php

namespace App\Services\Payment;

use Throwable;

class MidtransGateway implements PaymentGateway
{
    public function __construct(
        private readonly ?string $serverKey,
        private readonly bool $isProduction,
        private readonly bool $isSanitized,
        private readonly bool $is3ds,
    ) {
    }

    public function createSnapToken(array $params): string
    {
        $this->configure();

        try {
            return \Midtrans\Snap::getSnapToken($params);
        } catch (Throwable $e) {
            throw new PaymentGatewayException('Gagal membuat transaksi Midtrans: '.$e->getMessage(), 0, $e);
        }
    }

    public function status(string $orderId): array
    {
        $this->configure();

        try {
            $status = (array) \Midtrans\Transaction::status($orderId);
        } catch (Throwable $e) {
            throw new PaymentGatewayException('Gagal mengambil status Midtrans: '.$e->getMessage(), 0, $e);
        }

        return [
            'transaction_status' => (string) ($status['transaction_status'] ?? 'pending'),
            'payment_type' => $status['payment_type'] ?? null,
            'gross_amount' => $status['gross_amount'] ?? null,
            'fraud_status' => $status['fraud_status'] ?? null,
        ];
    }

    public function verifySignature(array $payload): bool
    {
        if (! $this->serverKey || empty($payload['signature_key'])) {
            return false;
        }

        $expected = hash('sha512',
            ($payload['order_id'] ?? '').
            ($payload['status_code'] ?? '').
            ($payload['gross_amount'] ?? '').
            $this->serverKey
        );

        return hash_equals($expected, (string) $payload['signature_key']);
    }

    private function configure(): void
    {
        if (! $this->serverKey) {
            throw new PaymentGatewayException('MIDTRANS_SERVER_KEY belum dikonfigurasi.');
        }

        \Midtrans\Config::$serverKey = $this->serverKey;
        \Midtrans\Config::$isProduction = $this->isProduction;
        \Midtrans\Config::$isSanitized = $this->isSanitized;
        \Midtrans\Config::$is3ds = $this->is3ds;
    }
}
