<?php

namespace App\Enums;

enum ImportStatus: string
{
    //'uploaded', 'processing', 'completed', 'failed', 'cancelled'
    case UPLOADED = 'uploaded';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
}
