<?php

namespace App\Enums;

enum CompanyStatus: string
{
    //'active', 'inactive', 'suspended', 'pending'
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';
    case PENDING = 'pending';
}
