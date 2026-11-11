<?php

namespace Tests\Fakes;

use App\Services\Payment\PaymentGateway;
use App\Services\Payment\PaymentGatewayException;

class FakePaymentGateway implements PaymentGateway
{
    public const SERVER_KEY = 'test-server-key';

    /** @var array<int, array<string, mixed>> */
    public array $snapRequests = [];

    public bool $failSnap = false;

    public string $statusToReturn = 'settlement';

    public function createSnapToken(array $params): string
    {
        if ($this->failSnap) {
            throw new PaymentGatewayException('Midtrans down');
        }

        $this->snapRequests[] = $params;

        return 'snap-token-'.count($this->snapRequests);
    }

    public function status(string $orderId): array
    {
        return [
            'transaction_status' => $this->statusToReturn,
            'payment_type' => 'bank_transfer',
            'gross_amount' => null,
            'fraud_status' => 'accept',
        ];
    }

    public function verifySignature(array $payload): bool
    {
        return isset($payload['signature_key']) && hash_equals(self::sign($payload), (string) $payload['signature_key']);
    }

    public static function sign(array $payload): string
    {
        return hash('sha512', $payload['order_id'].$payload['status_code'].$payload['gross_amount'].self::SERVER_KEY);
    }
}
