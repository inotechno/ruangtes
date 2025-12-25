<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CartRepository extends BaseRepository
{
    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
    }

    /**
     * Get or create cart for user
     */
    public function getOrCreateCart(User $user): Cart
    {
        $cart = $this->model->where('user_id', $user->id)
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->first();

        if (!$cart) {
            $cart = $this->create([
                'user_id' => $user->id,
                'expires_at' => now()->addHours(24), // Cart expires in 24 hours
            ]);
        }

        return $cart;
    }

    /**
     * Add test to cart
     */
    public function addToCart(Cart $cart, string $testId, int $quantity = 1, array $options = []): bool
    {
        $cart->addItem($testId, $quantity, $options);
        return true;
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(Cart $cart, string $testId): bool
    {
        $cart->removeItem($testId);
        return true;
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity(Cart $cart, string $testId, int $quantity): bool
    {
        $cart->updateQuantity($testId, $quantity);
        return true;
    }

    /**
     * Apply coupon to cart
     */
    public function applyCoupon(Cart $cart, string $couponCode): bool
    {
        // Logic untuk validate dan apply coupon
        // Implementation depends on your coupon system
        return $cart->update(['coupon_code' => $couponCode]);
    }

    /**
     * Clear cart
     */
    public function clearCart(Cart $cart): bool
    {
        $cart->clear();
        return true;
    }

    /**
     * Get cart total
     */
    public function getCartTotal(Cart $cart): float
    {
        return $cart->total;
    }

    /**
     * Get cart items count
     */
    public function getCartItemsCount(Cart $cart): int
    {
        return $cart->getItemCount();
    }

    /**
     * Check if cart has items
     */
    public function hasItems(Cart $cart): bool
    {
        return !empty($cart->items);
    }

    /**
     * Validate cart items (check if tests are still available)
     */
    public function validateCart(Cart $cart): array
    {
        $errors = [];
        $warnings = [];

        foreach ($cart->items ?? [] as $item) {
            $test = Test::find($item['test_id']);

            if (!$test) {
                $errors[] = "Test {$item['name']} is no longer available";
                continue;
            }

            if (!$test->isPublished()) {
                $warnings[] = "Test {$item['name']} is not currently published";
            }

            if ($test->price !== $item['price']) {
                $warnings[] = "Price for {$item['name']} has changed from {$item['price']} to {$test->price}";
            }
        }

        return ['errors' => $errors, 'warnings' => $warnings];
    }

    /**
     * Get expired carts
     */
    public function getExpiredCarts(): Collection
    {
        return $this->model->expired()->get();
    }

    /**
     * Clean expired carts
     */
    public function cleanExpiredCarts(): int
    {
        return $this->model->expired()->delete();
    }

    /**
     * Get user's cart history
     */
    public function getUserCartHistory(User $user): Collection
    {
        return $this->model->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
