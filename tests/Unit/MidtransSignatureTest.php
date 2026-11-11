<?php

namespace Tests\Unit;

use App\Services\Payment\MidtransGateway;
use PHPUnit\Framework\TestCase;

class MidtransSignatureTest extends TestCase
{
    public function test_verifies_signature_per_midtrans_spec(): void
    {
        $gateway = new MidtransGateway('server-key', false, true, true);
        $payload = ['order_id' => 'SKO-1', 'status_code' => '200', 'gross_amount' => '100000.00'];
        $payload['signature_key'] = hash('sha512', 'SKO-1200100000.00server-key');

        $this->assertTrue($gateway->verifySignature($payload));
        $this->assertFalse($gateway->verifySignature([...$payload, 'gross_amount' => '1.00']));
        $this->assertFalse($gateway->verifySignature([...$payload, 'signature_key' => '']));
        $this->assertFalse((new MidtransGateway(null, false, true, true))->verifySignature($payload));
    }
}
