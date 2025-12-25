<?php

namespace App\Enums;

enum ParticipantTestAssignmentStatus: string
{
    case PENDING = 'pending';
    case AVAILABLE = 'available';
    case INSTRUCTIONS = 'instructions';
    case IN_PROGRESS = 'in_progress';
    case PAUSED = 'paused';
    case COMPLETED = 'completed';
    case EXPIRED = 'expired';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
}
