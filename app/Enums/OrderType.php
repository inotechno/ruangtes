<?php

namespace App\Enums;

enum OrderType: string
{
    // 'test_purchase', 'subscription', 'bulk_purchase'
    case TEST_PURCHASE = 'test_purchase';
    case SUBSCRIPTION = 'subscription';
    case BULK_PURCHASE = 'bulk_purchase';
}
