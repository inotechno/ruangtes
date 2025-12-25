<?php

namespace App\Enums;

enum AttemptStatus: string
{
    // 'created',          // Baru dibuat
    // 'instructions',     // Sedang membaca instruksi
    // 'in_progress',      // Sedang mengerjakan
    // 'paused',           // Dijeda
    // 'submitted',        // Submit manual
    // 'auto_submitted',   // Auto submit (timeout)
    // 'terminated',       // Dihentikan admin
    // 'expired',          // Kedaluwarsa
    // 'banned'            // Diblokir cheating
    
    case CREATED = 'created';
    case INSTRUCTIONS = 'instructions';
    case IN_PROGRESS = 'in_progress';
    case PAUSED = 'paused';
    case SUBMITTED = 'submitted';
    case AUTO_SUBMITTED = 'auto_submitted';
    case TERMINATED = 'terminated';
    case EXPIRED = 'expired';
    case BANNED = 'banned';
}
