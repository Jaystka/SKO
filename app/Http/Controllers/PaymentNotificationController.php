<?php

namespace App\Http\Controllers;

use App\Services\Payment\PaymentGateway;
use App\Services\PaymentStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Endpoint HTTP Notification Midtrans. Daftarkan URL berikut di dashboard Midtrans:
 *   {APP_URL}/payment/notification
 */
class PaymentNotificationController extends Controller
{
    public function __invoke(Request $request, PaymentGateway $gateway, PaymentStatusService $statuses): JsonResponse
    {
        $payload = $request->json()->all() ?: $request->all();

        if (! $gateway->verifySignature($payload)) {
            Log::warning('Notifikasi Midtrans dengan signature tidak valid', [
                'order_id' => $payload['order_id'] ?? null,
                'ip' => $request->ip(),
            ]);

            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transaction = $statuses->apply(
            (string) $payload['order_id'],
            (string) ($payload['transaction_status'] ?? 'pending'),
            $payload['payment_type'] ?? null,
            $payload['fraud_status'] ?? null,
        );

        if (! $transaction) {
            // 200 agar Midtrans tidak mengulang notifikasi untuk order yang tidak dikenal.
            Log::notice('Notifikasi Midtrans untuk order tidak dikenal', ['order_id' => $payload['order_id']]);

            return response()->json(['message' => 'Order not found, ignored']);
        }

        return response()->json(['message' => 'OK']);
    }
}
