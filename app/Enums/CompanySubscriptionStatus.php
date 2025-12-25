<?php

namespace App\Enums;

enum CompanySubscriptionStatus: string
{
    //'active', 'pending', 'expired', 'cancelled', 'suspended'
    case ACTIVE = 'active';
    case PENDING = 'pending';
    case EXPIRED = 'expired';
    case CANCELLED = 'cancelled';
    case SUSPENDED = 'suspended';
}
