<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    /**
     * Create order from cart
     */
    public function createFromCart(Cart $cart, array $billingData = []): Order
    {
        return $this->transaction(function() use ($cart, $billingData) {
            $order = $this->create([
                'user_id' => $cart->user_id,
                'order_type' => 'test_purchase',
                'status' => 'pending',
                'subtotal' => $cart->subtotal,
                'tax_amount' => $cart->tax_amount,
                'discount_amount' => $cart->discount_amount,
                'total' => $cart->total,
                'billing_name' => $billingData['billing_name'] ?? null,
                'billing_email' => $billingData['billing_email'] ?? null,
                'billing_address' => $billingData['billing_address'] ?? null,
                'billing_city' => $billingData['billing_city'] ?? null,
                'billing_state' => $billingData['billing_state'] ?? null,
                'billing_postal_code' => $billingData['billing_postal_code'] ?? null,
                'billing_country' => $billingData['billing_country'] ?? null,
            ]);

            // Create order items
            foreach ($cart->items ?? [] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_type' => 'test',
                    'item_id' => $item['test_id'],
                    'item_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity'],
                    'item_options' => $item['options'] ?? null,
                ]);
            }

            // Clear cart after order creation
            $cart->clear();

            return $order;
        });
    }

    /**
     * Get user's orders
     */
    public function getUserOrders(User $user): Collection
    {
        return $this->model->where('user_id', $user->id)
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Find order by number
     */
    public function findByOrderNumber(string $orderNumber): ?Order
    {
        return $this->model->where('order_number', $orderNumber)->first();
    }

    /**
     * Mark order as paid
     */
    public function markAsPaid(Order $order, string $paymentReference = null, string $paymentMethod = null): bool
    {
        $order->markAsPaid($paymentReference, $paymentMethod);
        return true;
    }

    /**
     * Cancel order
     */
    public function cancelOrder(Order $order): bool
    {
        return $order->cancel();
    }

    /**
     * Complete order
     */
    public function completeOrder(Order $order): bool
    {
        return $order->update([
            'status' => 'completed',
        ]);
    }

    /**
     * Get pending orders
     */
    public function getPendingOrders(): Collection
    {
        return $this->model->pending()->get();
    }

    /**
     * Get paid orders
     */
    public function getPaidOrders(): Collection
    {
        return $this->model->paid()->get();
    }

    /**
     * Get completed orders
     */
    public function getCompletedOrders(): Collection
    {
        return $this->model->completed()->get();
    }

    /**
     * Get orders by type
     */
    public function getOrdersByType(string $type): Collection
    {
        return $this->model->where('order_type', $type)->get();
    }

    /**
     * Search orders
     */
    public function search(string $query): Collection
    {
        return $this->model->where(function($q) use ($query) {
            $q->where('order_number', 'like', "%{$query}%")
              ->orWhere('billing_name', 'like', "%{$query}%")
              ->orWhere('billing_email', 'like', "%{$query}%");
        })->get();
    }

    /**
     * Get order statistics
     */
    public function getOrderStatistics(): array
    {
        $stats = $this->model->selectRaw('
            COUNT(*) as total_orders,
            SUM(total) as total_revenue,
            COUNT(CASE WHEN status = "completed" THEN 1 END) as completed_orders,
            COUNT(CASE WHEN status = "pending" THEN 1 END) as pending_orders,
            AVG(total) as average_order_value
        ')->first();

        return [
            'total_orders' => $stats->total_orders ?? 0,
            'total_revenue' => $stats->total_revenue ?? 0,
            'completed_orders' => $stats->completed_orders ?? 0,
            'pending_orders' => $stats->pending_orders ?? 0,
            'average_order_value' => $stats->average_order_value ?? 0,
        ];
    }

    /**
     * Get orders by date range
     */
    public function getOrdersByDateRange(string $startDate, string $endDate): Collection
    {
        return $this->model->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Process payment for order
     */
    public function processPayment(Order $order, array $paymentData): bool
    {
        return $this->transaction(function() use ($order, $paymentData) {
            $order->update([
                'payment_method' => $paymentData['payment_method'],
                'payment_gateway' => $paymentData['payment_gateway'] ?? null,
                'payment_reference' => $paymentData['payment_reference'] ?? null,
                'paid_at' => now(),
                'status' => 'paid',
            ]);

            return true;
        });
    }

    /**
     * Refund order
     */
    public function refundOrder(Order $order, float $refundAmount = null, string $reason = null): bool
    {
        $refundAmount = $refundAmount ?? $order->total;

        return $order->update([
            'status' => 'refunded',
            'notes' => ($order->notes ?? '') . "\nRefunded: {$refundAmount} - {$reason}",
        ]);
    }

    /**
     * Get orders needing attention
     */
    public function getOrdersNeedingAttention(): Collection
    {
        return $this->model->where(function($query) {
            $query->where('status', 'payment_pending')
                  ->where('created_at', '<', now()->subHours(24)) // Pending > 24 hours
                  ->orWhere('status', 'paid')
                  ->where('created_at', '<', now()->subHours(48)); // Paid but not completed
        })->get();
    }
}
