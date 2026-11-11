<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function ProductCategoriesView(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $search = mb_substr($search, 0, 100);

        $products = Product::query()
            ->with('brand')
            ->when($search !== '', function ($query) use ($search) {
                $like = '%'.addcslashes($search, '%_\\').'%';
                $query->where(function ($q) use ($like) {
                    $q->where('series', 'like', $like)
                        ->orWhere('product', 'like', $like)
                        ->orWhereHas('brand', fn ($b) => $b->where('brand', 'like', $like));
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $title = $search !== ''
            ? 'Hasil pencarian "'.$search.'"'
            : 'Semua Sepatu';

        return view('shop.productcategory', compact('products', 'title', 'search'));
    }
}
