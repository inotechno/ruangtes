<?php

namespace App\Enums;

enum Gender: string
{
    //'male', 'female', 'other'
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';
}
