<?php

namespace Tests\Feature;

use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsShop;
use Tests\TestCase;

class CartTest extends TestCase
{
    use BuildsShop, RefreshDatabase;

    public function test_adding_same_item_increments_quantity_and_price(): void
    {
        $customer = $this->makeCustomer();
        $product = $this->makeProduct(['40' => 5], price: 100000);

        $this->actingAs($customer, 'web');
        $this->post('/cart', ['product_id' => $product->product_id, 'size' => '40'])->assertRedirect('/cart');
        $this->post('/cart', ['product_id' => $product->product_id, 'size' => '40', 'quantity' => 2]);

        $cart = Cart::sole();
        $this->assertSame(3, $cart->quantity);
        $this->assertSame(300000, $cart->cart_price);
        $this->assertSame($customer->customer_id, $cart->customer_id);
    }

    public function test_cannot_add_more_than_stock_or_out_of_stock_size(): void
    {
        $product = $this->makeProduct(['40' => 2, '41' => 0]);
        $this->actingAs($this->makeCustomer(), 'web');

        $this->postJson('/cart', ['product_id' => $product->product_id, 'size' => '41'])
            ->assertStatus(422)->assertJsonValidationErrors('size');
        $this->postJson('/cart', ['product_id' => $product->product_id, 'size' => '40', 'quantity' => 3])
            ->assertStatus(422)->assertJsonValidationErrors('quantity');
        $this->postJson('/cart', ['product_id' => $product->product_id, 'size' => '99'])
            ->assertStatus(422)->assertJsonValidationErrors('size');

        $this->assertSame(0, Cart::count());
    }

    public function test_customer_id_from_request_is_ignored(): void
    {
        $me = $this->makeCustomer();
        $other = $this->makeCustomer();
        $product = $this->makeProduct();

        $this->actingAs($me, 'web')->post('/cart', [
            'customer_id' => $other->customer_id,
            'product_id' => $product->product_id,
            'size' => '40',
        ]);

        $this->assertSame($me->customer_id, Cart::sole()->customer_id);
    }

    public function test_cannot_modify_or_delete_other_customers_cart(): void
    {
        $owner = $this->makeCustomer();
        $attacker = $this->makeCustomer();
        $product = $this->makeProduct();

        $this->actingAs($owner, 'web')->post('/cart', ['product_id' => $product->product_id, 'size' => '40']);
        $cart = Cart::sole();

        $this->actingAs($attacker, 'web');
        $this->putJson('/cart/update/'.$cart->cart_id, ['quantity' => 2])->assertNotFound();
        $this->deleteJson('/cart/'.$cart->cart_id)->assertNotFound();
        $this->postJson('/checkout', ['options' => [['cart_id' => $cart->cart_id, 'status' => 0]]])->assertOk();

        $this->assertDatabaseHas('carts', ['cart_id' => $cart->cart_id, 'quantity' => 1, 'status' => '1']);
    }

    public function test_update_quantity_recalculates_price_server_side(): void
    {
        $product = $this->makeProduct(['40' => 5], price: 150000);
        $this->actingAs($this->makeCustomer(), 'web')->post('/cart', ['product_id' => $product->product_id, 'size' => '40']);
        $cart = Cart::sole();

        $this->putJson('/cart/update/'.$cart->cart_id, ['quantity' => 4, 'total' => 1])
            ->assertOk()
            ->assertJson(['quantity' => 4, 'cart_price' => 600000]);

        $this->putJson('/cart/update/'.$cart->cart_id, ['quantity' => 6])->assertStatus(422);
        $this->putJson('/cart/update/'.$cart->cart_id, ['quantity' => 0])->assertStatus(422);
    }

    public function test_cart_items_fragment_renders(): void
    {
        $product = $this->makeProduct();
        $this->actingAs($this->makeCustomer(), 'web')->post('/cart', ['product_id' => $product->product_id, 'size' => '40']);

        $this->get('/cart')->assertOk();
        $this->get('/cart/items')->assertOk()->assertSee($product->series);
    }
}
