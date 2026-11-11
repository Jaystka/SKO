<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user('admin') !== null;
    }

    protected function prepareForValidation(): void
    {
        // Harga boleh diketik "1.250.000" atau "1250000".
        if (is_string($this->price)) {
            $this->merge(['price' => preg_replace('/[^0-9]/', '', $this->price)]);
        }
    }

    public function rules(): array
    {
        $creating = $this->isMethod('post');

        return [
            'brand_id' => ['required', 'string', Rule::exists('brands', 'brand_id')],
            'category_id' => ['required', 'string', Rule::exists('categories', 'category_id')],
            'material_id' => ['required', 'string', Rule::exists('materials', 'material_id')],
            'series' => ['required', 'string', 'max:150'],
            'price' => ['required', 'integer', 'min:1000', 'max:1000000000'],
            'description' => ['required', 'string', 'max:5000'],
            'image' => [$creating ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sizes' => ['nullable', 'array'],
            'sizes.*' => ['nullable', 'integer', 'min:0', 'max:100000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'brand_id' => 'brand',
            'category_id' => 'kategori',
            'material_id' => 'material',
            'series' => 'nama seri',
            'price' => 'harga',
            'description' => 'deskripsi',
            'image' => 'gambar',
            'sizes.*' => 'stok',
        ];
    }

    /**
     * Stok per ukuran yang diisi (ukuran yang tidak dikenal diabaikan).
     *
     * @return array<string, int>
     */
    public function sizes(): array
    {
        return collect($this->validated('sizes') ?? [])
            ->filter(fn ($qty, $size) => $qty !== null && $qty !== '' && in_array((string) $size, Product::SIZES, true))
            ->mapWithKeys(fn ($qty, $size) => [(string) $size => (int) $qty])
            ->all();
    }
}
