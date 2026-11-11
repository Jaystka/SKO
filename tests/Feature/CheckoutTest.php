<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Stocks;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsShop;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use BuildsShop, RefreshDatabase;

    private function shipping(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Budi',
            'phone' => '081234567890',
            'address' => 'Jl. Kaliurang Km 5, Sleman',
            'expedition' => 'JNE',
        ], $overrides);
    }

    public function test_checkout_page_requires_selected_items(): void
    {
        $this->actingAs($this->makeCustomer(), 'web');

        $this->get('/checkout')->assertRedirect('/cart');
    }

    public function test_checkout_page_shows_summary(): void
    {
        $product = $this->makeProduct(['40' => 5], price: 200000, tax: 5000);
        $this->makeExpedition();
        $this->actingAs($this->makeCustomer(), 'web')->post('/cart', ['product_id' => $product->product_id, 'size' => '40']);

        $this->get('/checkout')->assertOk()->assertSee('205.000');
    }

    public function test_process_creates_transaction_and_charges_displayed_total(): void
    {
        $gateway = $this->fakeGateway();
        $this->makeExpedition();
        $customer = $this->makeCustomer();
        $a = $this->makeProduct(['40' => 5], price: 200000, tax: 5000);
        $b = $this->makeProduct(['42' => 5], price: 100000);

        $this->actingAs($customer, 'web');
        $this->post('/cart', ['product_id' => $a->product_id, 'size' => '40', 'quantity' => 2]);
        $this->post('/cart', ['product_id' => $b->product_id, 'size' => '42']);

        $response = $this->postJson('/payment', $this->shipping())
            ->assertOk()
            ->assertJsonStructure(['token', 'order_id']);

        $transaction = Transaction::findOrFail($response->json('order_id'));
        $this->assertSame(505000, $transaction->total_payment);
        $this->assertSame('pending', $transaction->status);
        $this->assertSame('snap-token-1', $transaction->snap_token);
        $this->assertSame(2, Payment::count());
        $this->assertSame(['PY001', 'PY002'], Payment::orderBy('payment_id')->pluck('payment_id')->all());
        $this->assertSame(0, Cart::count());

        $params = $gateway->snapRequests[0];
        $this->assertSame(505000, $params['transaction_details']['gross_amount']);
        $itemsTotal = collect($params['item_details'])->sum(fn ($i) => $i['price'] * $i['quantity']);
        $this->assertSame(505000, $itemsTotal, 'Midtrans menolak bila jumlah item != gross_amount');
    }

    public function test_only_selected_items_are_checked_out(): void
    {
        $this->fakeGateway();
        $this->makeExpedition();
        $a = $this->makeProduct();
        $b = $this->makeProduct();

        $this->actingAs($this->makeCustomer(), 'web');
        $this->post('/cart', ['product_id' => $a->product_id, 'size' => '40']);
        $this->post('/cart', ['product_id' => $b->product_id, 'size' => '40']);
        $cartB = Cart::where('product_id', $b->product_id)->sole();
        $this->postJson('/checkout', ['options' => [['cart_id' => $cartB->cart_id, 'status' => 0]]])->assertOk();

        $this->postJson('/payment', $this->shipping())->assertOk();

        $this->assertSame([$a->product_id], Payment::pluck('product_id')->all());
        $this->assertDatabaseHas('carts', ['cart_id' => $cartB->cart_id]);
    }

    public function test_gateway_failure_rolls_back_everything(): void
    {
        $this->fakeGateway()->failSnap = true;
        $this->makeExpedition();
        $product = $this->makeProduct();

        $this->actingAs($this->makeCustomer(), 'web')->post('/cart', ['product_id' => $product->product_id, 'size' => '40']);

        $this->postJson('/payment', $this->shipping())->assertStatus(502);

        $this->assertSame(0, Transaction::count());
        $this->assertSame(0, Payment::count());
        $this->assertSame(1, Cart::count());
    }

    public function test_process_validates_input(): void
    {
        $this->fakeGateway();
        $this->actingAs($this->makeCustomer(), 'web');

        $this->postJson('/payment', $this->shipping(['expedition' => 'Pilih Kurir', 'phone' => 'abc']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['expedition', 'phone']);
    }

    public function test_process_fails_when_stock_ran_out(): void
    {
        $this->fakeGateway();
        $this->makeExpedition();
        $product = $this->makeProduct(['40' => 2]);

        $this->actingAs($this->makeCustomer(), 'web')->post('/cart', ['product_id' => $product->product_id, 'size' => '40', 'quantity' => 2]);
        Stocks::query()->update(['total_stock' => 1]);

        $this->postJson('/payment', $this->shipping())->assertStatus(422)->assertJsonValidationErrors('checkout');
        $this->assertSame(0, Transaction::count());
    }

    public function test_check_status_only_for_own_orders(): void
    {
        $gateway = $this->fakeGateway();
        $this->makeExpedition();
        $owner = $this->makeCustomer();
        $product = $this->makeProduct(['40' => 3]);

        $this->actingAs($owner, 'web')->post('/cart', ['product_id' => $product->product_id, 'size' => '40']);
        $orderId = $this->postJson('/payment', $this->shipping())->json('order_id');

        $this->actingAs($this->makeCustomer(), 'web')
            ->postJson('/check-payment-status', ['order_id' => $orderId])
            ->assertNotFound();

        $gateway->statusToReturn = 'settlement';
        $this->actingAs($owner, 'web')
            ->postJson('/check-payment-status', ['order_id' => $orderId])
            ->assertOk()
            ->assertJson(['status' => 'settlement', 'paid' => true]);

        $this->assertSame(2, Stocks::sole()->total_stock);
    }
}
