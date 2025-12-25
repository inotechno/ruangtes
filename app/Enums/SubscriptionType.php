<?php

namespace App\Enums;

enum SubscriptionType: string
{
    //'prepaid', 'postpaid', 'trial'
    case PREPAID = 'prepaid';
    case POSTPAID = 'postpaid';
    case TRIAL = 'trial';
}
