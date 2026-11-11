<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsShop;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use BuildsShop, RefreshDatabase;

    public function test_static_pages_load(): void
    {
        foreach (['/', '/ourstory', '/blog', '/login', '/register', '/admin/login'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_shop_loads_without_display_configuration(): void
    {
        $product = $this->makeProduct();

        $this->get('/shop')->assertOk()->assertSee($product->series);
    }

    public function test_search_matches_series_and_brand_and_escapes_wildcards(): void
    {
        $product = $this->makeProduct();

        $this->get('/categories?search=Gazelle')->assertOk()->assertSee($product->series);
        $this->get('/categories?search=compass')->assertOk()->assertSee($product->series);
        $this->get('/categories?search=%25')->assertOk()->assertDontSee($product->series);
    }

    public function test_product_page_and_404(): void
    {
        $product = $this->makeProduct(['40' => 3, '41' => 0]);

        $this->get('/product/'.$product->slug)->assertOk()->assertSee($product->series);
        $this->get('/product/tidak-ada')->assertNotFound();
    }

    public function test_security_headers_are_sent(): void
    {
        $this->get('/')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN');
    }

    public function test_guest_is_redirected_to_login_for_cart(): void
    {
        $this->get('/cart')->assertRedirect('/login');
        $this->get('/admin/dashboard')->assertRedirect('/admin/login');
    }
}
