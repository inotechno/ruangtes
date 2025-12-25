<?php

namespace App\Enums;

enum BillingCycle: string
{
    //'monthly', 'quarterly', 'semi_annual', 'annual', 'custom'
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case SEMI_ANNUAL = 'semi_annual';
    case ANNUAL = 'annual';
    case CUSTOM = 'custom';
}
