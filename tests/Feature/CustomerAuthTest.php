<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsShop;
use Tests\TestCase;

class CustomerAuthTest extends TestCase
{
    use BuildsShop, RefreshDatabase;

    public function test_register_generates_sequential_ids_and_hashes_password(): void
    {
        $this->postJson('/register', ['name' => 'budi', 'email' => 'Budi@Example.test', 'password' => 'password123'])
            ->assertCreated();
        $this->postJson('/register', ['name' => 'ani', 'email' => 'ani@example.test', 'password' => 'password123'])
            ->assertCreated();

        $budi = Customer::where('email', 'budi@example.test')->firstOrFail();
        $this->assertSame('C0001', $budi->customer_id);
        $this->assertNotSame('password123', $budi->password);
        $this->assertSame('C0002', Customer::where('email', 'ani@example.test')->value('customer_id'));
    }

    public function test_register_rejects_duplicate_email(): void
    {
        $this->makeCustomer(['email' => 'dup@example.test']);

        $this->postJson('/register', ['name' => 'x', 'email' => 'dup@example.test', 'password' => 'password123'])
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');
    }

    public function test_login_and_logout(): void
    {
        $customer = $this->makeCustomer();

        $this->postJson('/login', ['email' => $customer->email, 'password' => 'password123'])
            ->assertOk()
            ->assertJson(['success' => true]);
        $this->assertAuthenticatedAs($customer, 'web');

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest('web');
    }

    public function test_login_is_rate_limited(): void
    {
        $customer = $this->makeCustomer();

        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/login', ['email' => $customer->email, 'password' => 'wrong'])->assertStatus(401);
        }

        $this->postJson('/login', ['email' => $customer->email, 'password' => 'password123'])->assertStatus(429);
        $this->assertGuest('web');
    }

    public function test_logout_via_get_is_not_allowed(): void
    {
        $this->actingAs($this->makeCustomer(), 'web');

        $this->get('/logout')->assertStatus(405);
    }

    public function test_customer_can_only_update_own_profile(): void
    {
        $me = $this->makeCustomer();
        $other = $this->makeCustomer();

        $this->actingAs($me, 'web')
            ->putJson('/editprofile/'.$other->customer_id, [
                'username' => 'baru', 'name' => 'Nama Baru', 'phone' => '0812-3456-7890', 'address' => 'Alamat',
            ])->assertOk();

        $this->assertSame('baru', $me->fresh()->username);
        $this->assertNotSame('baru', $other->fresh()->username);
    }
}
