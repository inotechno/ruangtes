<?php

namespace App\Enums;

enum ImportType: string
{
    //'participants', 'tests', 'companies'
    case PARTICIPANTS = 'participants';
    case TESTS = 'tests';
    case COMPANIES = 'companies';
}
