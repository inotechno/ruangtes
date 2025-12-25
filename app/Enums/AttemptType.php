<?php

namespace App\Enums;

enum AttemptType: string
{
    //
    case COMPANY_PARTICIPANT = 'company_participant';
    case COMPANY_PUBLIC = 'company_public';
    case DIRECT_PUBLIC = 'direct_public';
    case TRIAL = 'trial';
    case DEMO = 'demo';
}
