<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    private const SESSION_KEY = 'cart';

    public function quantities(): array
    {
        return session(self::SESSION_KEY, []);
    }

    public function items(): Collection
    {
        $quantities = $this->quantities();

        if ($quantities === []) {
            return collect();
        }

        return Product::with('category')
            ->whereIn('id', array_keys($quantities))
            ->where('status', true)
            ->whereHas('category', fn ($query) => $query->where('status', true))
            ->get()
            ->map(function (Product $product) use ($quantities) {
                $product->cart_quantity = min((int) $quantities[$product->id], $product->stock);
                $product->cart_subtotal = (float) $product->price * $product->cart_quantity;

                return $product;
            })
            ->filter(fn (Product $product) => $product->cart_quantity > 0);
    }

    public function count(): int
    {
        return $this->items()->sum('cart_quantity');
    }

    public function total(): float
    {
        return $this->items()->sum('cart_subtotal');
    }

    public function put(Product $product, int $quantity): void
    {
        $cart = $this->quantities();
        $cart[$product->id] = $quantity;
        session([self::SESSION_KEY => $cart]);
    }

    public function add(Product $product, int $quantity): void
    {
        $current = (int) ($this->quantities()[$product->id] ?? 0);
        $this->put($product, min($current + $quantity, $product->stock));
    }

    public function remove(Product $product): void
    {
        $cart = $this->quantities();
        unset($cart[$product->id]);
        session([self::SESSION_KEY => $cart]);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }
}
