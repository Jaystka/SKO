<?php

namespace Tests\Concerns;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Customer;
use App\Models\Expedition;
use App\Models\Materials;
use App\Models\Product;
use App\Models\Stocks;
use App\Models\Tax;
use App\Models\User;
use App\Services\Payment\PaymentGateway;
use Tests\Fakes\FakePaymentGateway;

trait BuildsShop
{
    protected FakePaymentGateway $gateway;

    protected function fakeGateway(): FakePaymentGateway
    {
        $this->gateway = new FakePaymentGateway;
        $this->app->instance(PaymentGateway::class, $this->gateway);

        return $this->gateway;
    }

    protected function makeCustomer(array $attributes = []): Customer
    {
        static $n = 0;
        $n++;

        return Customer::create(array_merge([
            'customer_id' => sprintf('C9%03d', $n),
            'username' => "customer{$n}",
            'name' => "Customer {$n}",
            'email' => "customer{$n}@example.test",
            'password' => 'password123',
            'phone' => '081234567890',
            'address' => 'Jl. Malioboro No. 1, Yogyakarta',
        ], $attributes));
    }

    protected function makeAdmin(): User
    {
        return User::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'secret-password',
        ]);
    }

    /**
     * @param  array<string, int>  $stock  ukuran => jumlah
     */
    protected function makeProduct(array $stock = ['40' => 5], int $price = 250000, ?int $tax = null, array $attributes = []): Product
    {
        static $n = 0;
        $n++;

        $brand = Brands::firstOrCreate(['brand_id' => 'B0001'], ['brand' => 'Compass']);
        $category = Categories::firstOrCreate(['category_id' => 'C0001'], ['category' => 'Low', 'category_desc' => 'Low top']);
        $material = Materials::firstOrCreate(['material_id' => 'M0001'], ['material' => 'Canvas', 'material_desc' => 'Kanvas']);
        $taxRow = $tax !== null ? Tax::firstOrCreate(['tax_id' => 'T'.$tax], ['tax' => $tax]) : null;

        $product = Product::create(array_merge([
            'product_id' => sprintf('P%04d', $n),
            'brand_id' => $brand->brand_id,
            'category_id' => $category->category_id,
            'material_id' => $material->material_id,
            'tax_id' => $taxRow?->tax_id,
            'series' => "Gazelle {$n}",
            'price' => $price,
            'description' => 'Sepatu kanvas lokal.',
            'slug' => "gazelle-{$n}",
            'image' => 'dist/img/sepatu 1.png',
        ], $attributes));

        $i = 0;
        foreach ($stock as $size => $qty) {
            Stocks::create([
                'stock_id' => sprintf('S%04d%02d', $n, ++$i),
                'product_id' => $product->product_id,
                'size' => (string) $size,
                'total_stock' => $qty,
            ]);
        }

        return $product;
    }

    protected function makeExpedition(string $name = 'JNE'): Expedition
    {
        return Expedition::firstOrCreate(['expedition' => $name]);
    }
}
