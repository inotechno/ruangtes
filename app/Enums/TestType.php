<?php

namespace App\Enums;

enum TestType: string
{
    // 'public', 'company', 'all'
    case PUBLIC = 'public';
    case COMPANY = 'company';
    case ALL = 'all';
}
