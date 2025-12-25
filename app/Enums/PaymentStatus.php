<?php

namespace App\Enums;

enum PaymentStatus: string
{
    // 'free', 'paid', 'pending', 'refunded'
    case FREE = 'free';
    case PAID = 'paid';
    case PENDING = 'pending';
    case REFUNDED = 'refunded';
}
