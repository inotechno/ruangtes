<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'order_type',
        'status',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'shipping_amount',
        'total',
        'payment_method',
        'payment_gateway',
        'payment_reference',
        'paid_at',
        'billing_name',
        'billing_email',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_postal_code',
        'billing_country',
        'notes',
        'metadata',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'metadata' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper methods
    public function isPaid(): bool
    {
        return in_array($this->status, ['paid', 'processing', 'completed']);
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'payment_pending']);
    }

    public function markAsPaid(string $paymentReference = null, string $paymentMethod = null)
    {
        $this->status = 'paid';
        $this->paid_at = now();
        $this->payment_reference = $paymentReference;
        $this->payment_method = $paymentMethod;
        $this->save();

        // Log the payment
        AuditLog::log(
            'order_paid',
            $this,
            $this->user,
            "Order {$this->order_number} marked as paid",
            ['status' => 'pending'],
            ['status' => 'paid', 'paid_at' => $this->paid_at]
        );
    }

    public function cancel()
    {
        if (!$this->canBeCancelled()) {
            throw new \Exception('Order cannot be cancelled');
        }

        $oldStatus = $this->status;
        $this->status = 'cancelled';
        $this->save();

        AuditLog::log(
            'order_cancelled',
            $this,
            $this->user,
            "Order {$this->order_number} cancelled",
            ['status' => $oldStatus],
            ['status' => 'cancelled']
        );
    }

    public function getItemCount(): int
    {
        return $this->items->sum('quantity');
    }

    // Scopes
    public function scopePaid($query)
    {
        return $query->whereIn('status', ['paid', 'processing', 'completed']);
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['pending', 'payment_pending']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('order_type', $type);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }
        });
    }
}
