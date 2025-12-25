<?php

namespace App\Enums;

enum CancelledBy: string
{
    // 'admin', 'company', 'system'
    case ADMIN = 'admin';
    case COMPANY = 'company';
    case SYSTEM = 'system';
}
