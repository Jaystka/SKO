<?php

namespace App\Services\Payment;

interface PaymentGateway
{
    /**
     * Membuat transaksi Snap dan mengembalikan snap token.
     *
     * @param  array<string, mixed>  $params
     *
     * @throws PaymentGatewayException
     */
    public function createSnapToken(array $params): string;

    /**
     * Mengambil status transaksi dari gateway.
     *
     * @return array{transaction_status: string, payment_type: ?string, gross_amount: ?string, fraud_status: ?string}
     *
     * @throws PaymentGatewayException
     */
    public function status(string $orderId): array;

    /** Memverifikasi signature_key dari notifikasi HTTP gateway. */
    public function verifySignature(array $payload): bool;
}
