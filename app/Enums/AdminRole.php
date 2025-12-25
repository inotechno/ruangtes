<?php

namespace App\Enums;

enum AdminRole: string
{
    //'owner', 'admin', 'manager', 'viewer'
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case VIEWER = 'viewer';
}
