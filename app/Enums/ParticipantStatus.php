<?php

namespace App\Enums;

enum ParticipantStatus: string
{
    // 'pending', 'active', 'testing', 'completed', 'banned', 'expired'
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case TESTING = 'testing';
    case COMPLETED = 'completed';
    case BANNED = 'banned';
    case EXPIRED = 'expired';
}
