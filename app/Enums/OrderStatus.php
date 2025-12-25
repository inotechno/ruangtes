<?php

namespace App\Enums;

enum OrderStatus: string
{
    // 'pending', 'payment_pending', 'paid', 'processing', 'completed', 'cancelled', 'refunded', 'failed'
    case PENDING = 'pending';
    case PAYMENT_PENDING = 'payment_pending';
    case PAID = 'paid';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';
    case FAILED = 'failed';
}
