<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'items',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total',
        'coupon_code',
        'expires_at',
    ];

    protected $casts = [
        'items' => 'array',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'expires_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function getItemCount(): int
    {
        return collect($this->items)->sum('quantity');
    }

    public function addItem(string $testId, int $quantity = 1, array $options = [])
    {
        $items = $this->items ?? [];
        $found = false;

        foreach ($items as &$item) {
            if ($item['test_id'] === $testId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $test = Test::find($testId);
            if ($test) {
                $items[] = [
                    'test_id' => $testId,
                    'name' => $test->name,
                    'price' => $test->getEffectivePrice(),
                    'quantity' => $quantity,
                    'options' => $options,
                ];
            }
        }

        $this->items = $items;
        $this->recalculateTotal();
        $this->save();
    }

    public function removeItem(string $testId)
    {
        $items = collect($this->items)->reject(function ($item) use ($testId) {
            return $item['test_id'] === $testId;
        })->toArray();

        $this->items = $items;
        $this->recalculateTotal();
        $this->save();
    }

    public function updateQuantity(string $testId, int $quantity)
    {
        if ($quantity <= 0) {
            $this->removeItem($testId);
            return;
        }

        $items = collect($this->items)->map(function ($item) use ($testId, $quantity) {
            if ($item['test_id'] === $testId) {
                $item['quantity'] = $quantity;
            }
            return $item;
        })->toArray();

        $this->items = $items;
        $this->recalculateTotal();
        $this->save();
    }

    public function clear()
    {
        $this->items = [];
        $this->subtotal = 0;
        $this->total = 0;
        $this->save();
    }

    protected function recalculateTotal()
    {
        $subtotal = 0;
        foreach ($this->items ?? [] as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        $this->subtotal = $subtotal;
        $this->total = $subtotal + $this->tax_amount - $this->discount_amount;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<=', now());
    }
}
