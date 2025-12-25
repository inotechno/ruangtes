<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'item_type',
        'item_id',
        'item_name',
        'item_description',
        'quantity',
        'unit_price',
        'total_price',
        'item_options',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'item_options' => 'array',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->morphTo(null, 'item_type', 'item_id');
    }

    // Helper methods
    public function getTest()
    {
        if ($this->item_type === 'test') {
            return Test::find($this->item_id);
        }
        return null;
    }

    public function getSubscriptionPlan()
    {
        if ($this->item_type === 'subscription') {
            return SubscriptionPlan::find($this->item_id);
        }
        return null;
    }

    public function calculateTotalPrice()
    {
        return $this->unit_price * $this->quantity;
    }

    // Scopes
    public function scopeByType($query, string $type)
    {
        return $query->where('item_type', $type);
    }

    public function scopeTests($query)
    {
        return $query->where('item_type', 'test');
    }

    public function scopeSubscriptions($query)
    {
        return $query->where('item_type', 'subscription');
    }
}
