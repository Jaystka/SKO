<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function __construct(private readonly CartService $carts)
    {
    }

    public function index()
    {
        return view('cart.cart');
    }

    /** Fragmen HTML daftar keranjang (dimuat via AJAX). */
    public function itemsView(Request $request)
    {
        $carts = $this->carts->activeItems($request->user());

        return view('cart.items', compact('carts'));
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'string', 'exists:products,product_id'],
            'size' => ['required', 'string', Rule::in(Product::SIZES)],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:'.Cart::MAX_QUANTITY],
        ], [
            'size.required' => 'Pilih ukuran terlebih dahulu.',
        ]);

        $product = Product::findOrFail($data['product_id']);
        $this->carts->add($request->user(), $product, $data['size'], (int) ($data['quantity'] ?? 1));

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Produk ditambahkan ke keranjang.']);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, string $cart_id): JsonResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.Cart::MAX_QUANTITY],
        ]);

        $cart = $this->findOwnCart($request, $cart_id);
        $cart = $this->carts->updateQuantity($cart, (int) $data['quantity']);

        return response()->json([
            'success' => true,
            'quantity' => $cart->quantity,
            'cart_price' => $cart->cart_price,
        ]);
    }

    public function destroy(Request $request, string $cart_id): JsonResponse
    {
        $this->findOwnCart($request, $cart_id)->delete();

        return response()->json(['success' => true, 'message' => 'Item dihapus dari keranjang.']);
    }

    private function findOwnCart(Request $request, string $cartId): Cart
    {
        return Cart::query()
            ->where('cart_id', $cartId)
            ->where('customer_id', $request->user()->customer_id)
            ->where('status', '!=', Cart::STATUS_ORDERED)
            ->firstOrFail();
    }
}
