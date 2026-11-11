<?php

namespace Tests\Feature;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Stocks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\Concerns\BuildsShop;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use BuildsShop, RefreshDatabase;

    protected function tearDown(): void
    {
        File::deleteDirectory(public_path('dist/img/products'));
        parent::tearDown();
    }

    public function test_customer_cannot_access_admin(): void
    {
        $this->actingAs($this->makeCustomer(), 'web')
            ->get('/admin/dashboard')
            ->assertRedirect('/admin/login');
    }

    public function test_admin_login_and_pages(): void
    {
        $admin = $this->makeAdmin();
        $this->makeProduct();

        $this->post('/admin/login', ['email' => $admin->email, 'password' => 'secret-password'])
            ->assertRedirect('/admin/dashboard');

        foreach (['dashboard', 'products', 'addproducts', 'category', 'addcategories', 'customers', 'materials', 'materials/add', 'transactions'] as $page) {
            $this->get('/admin/'.$page)->assertOk();
        }
    }

    public function test_admin_can_create_update_and_delete_product(): void
    {
        $this->actingAs($this->makeAdmin(), 'admin');
        $seed = $this->makeProduct(); // menyiapkan brand/kategori/material

        $this->post('/admin/addProducts', [
            'brand_id' => $seed->brand_id,
            'category_id' => $seed->category_id,
            'material_id' => $seed->material_id,
            'series' => 'Retrograde White',
            'price' => '1.250.000',
            'description' => 'Deskripsi',
            'image' => UploadedFile::fake()->image('shoe.png'),
            'sizes' => ['40' => '3', '41' => '0', '42' => ''],
        ])->assertRedirect('/admin/products')->assertSessionHasNoErrors();

        $product = Product::with('stocks')->where('series', 'Retrograde White')->firstOrFail();
        $this->assertSame(1250000, $product->price);
        $this->assertSame('retrograde-white', $product->slug);
        $this->assertFileExists(public_path($product->image));
        $this->assertEqualsCanonicalizing(['40' => 3, '41' => 0], $product->stocks->pluck('total_stock', 'size')->all());

        // Seri sama -> slug unik
        $this->post('/admin/addProducts', [
            'brand_id' => $seed->brand_id, 'category_id' => $seed->category_id, 'material_id' => $seed->material_id,
            'series' => 'Retrograde White', 'price' => 100000, 'description' => 'x',
            'image' => UploadedFile::fake()->image('shoe2.jpg'),
        ])->assertSessionHasNoErrors();
        $this->assertTrue(Product::where('slug', 'retrograde-white-2')->exists());

        // Update stok ke 0 harus tersimpan
        $this->put('/admin/update/retrograde-white', [
            'brand_id' => $seed->brand_id, 'category_id' => $seed->category_id, 'material_id' => $seed->material_id,
            'series' => 'Retrograde White', 'price' => 1300000, 'description' => 'Baru',
            'sizes' => ['40' => '0'],
        ])->assertRedirect('/admin/products')->assertSessionHasNoErrors();
        $this->assertSame(0, Stocks::where('product_id', $product->product_id)->where('size', '40')->value('total_stock'));

        $image = public_path($product->image);
        $this->delete('/admin/products/'.$product->product_id)->assertRedirect('/admin/products');
        $this->assertDatabaseMissing('products', ['product_id' => $product->product_id]);
        $this->assertDatabaseMissing('stocks', ['product_id' => $product->product_id]);
        $this->assertFileDoesNotExist($image);
    }

    public function test_product_upload_rejects_non_images(): void
    {
        $this->actingAs($this->makeAdmin(), 'admin');
        $seed = $this->makeProduct();

        $this->post('/admin/addProducts', [
            'brand_id' => $seed->brand_id, 'category_id' => $seed->category_id, 'material_id' => $seed->material_id,
            'series' => 'Hack', 'price' => 100000, 'description' => 'x',
            'image' => UploadedFile::fake()->create('shell.php', 10, 'application/x-php'),
        ])->assertSessionHasErrors('image');

        $this->assertFalse(Product::where('series', 'Hack')->exists());
    }

    public function test_category_crud_and_in_use_protection(): void
    {
        $this->actingAs($this->makeAdmin(), 'admin');
        $product = $this->makeProduct();

        $this->delete('/admin/deletecategory/'.$product->category_id)->assertSessionHas('error');
        $this->assertDatabaseHas('categories', ['category_id' => $product->category_id]);

        $this->post('/admin/addcategories', ['category' => 'High', 'category_desc' => 'High top'])->assertRedirect('/admin/category');
        $this->assertSame('C0002', Categories::where('category', 'High')->value('category_id'));
        $this->put('/admin/updatecategory/C0002', ['category' => 'High Top', 'category_desc' => 'x'])->assertRedirect('/admin/category');
        $this->delete('/admin/deletecategory/C0002')->assertSessionHas('success');
    }
}
