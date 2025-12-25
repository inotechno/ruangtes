<?php

namespace App\Enums;

enum PaymentMethod: string
{
    // 'bank_transfer', 'credit_card', 'virtual_account', 'ewallet', 'manual'
    case BANK_TRANSFER = 'bank_transfer';
    case CREDIT_CARD = 'credit_card';
    case VIRTUAL_ACCOUNT = 'virtual_account';
    case EWALLET = 'ewallet';
    case MANUAL = 'manual';
}
